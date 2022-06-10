<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/NutritionalStorData.php");
  include(__DIR__ . "/Data/NutritionalNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/NutritionalStor.php");
  include(__DIR__ . "/Storage/NutritionalNameStor.php");

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($nutritionalStorData, $jsonError) = NutritionalStorData::getJsonData($dataSvc->getParameter("data"));
    list($nutritionalNamesStorData, $jsonErrorName) = NutritionalNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

    if ($jsonError->getCode() == "") {
      if ($dbConnection->beginTransaction()) {
        $canSave = true;
        if ($nutritionalStorData->getId() == 0) {
          // Verify Code Exist
          $currentNutritionalStorData = NutritionalStor::findByCode($nutritionalStorData, $dbConnection);
          if ($currentNutritionalStorData->getId() > 0) {
            $canSave             = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("The Code " . $nutritionalStorData->getCode() . " is already in use");
            $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
            $errorData = $distriXSvcErrorData;
          }
        }
        if ($canSave) {
          list($insere, $idNutritionalStorData) = NutritionalStor::save($nutritionalStorData, $dbConnection);
          if ($insere) {
            foreach ($nutritionalNamesStorData as $nutritionalNameStorData) {
              $nutritionalNameStorData->setIdNutritional($idNutritionalStorData);
              list($insere, $idNutritionalNameStorData) = NutritionalNameStor::save($nutritionalNameStorData, $dbConnection);
              if (!$insere) { break; }
            }
            if (!$insere) {
              // Error with NutritionalNames
            }
          } else {
            // Error with Nutritional
          }
          if ($insere) {
            $dbConnection->commit();
          } else {
            $dbConnection->rollBack();
            if ($nutritionalStorData->getId() > 0) {
              $errorData = ApplicationErrorData::warningUpdateData(1, 1);
            } else {
              $errorData = ApplicationErrorData::warningInsertData(1, 1);
            }
          }
        }
      } else {
        $errorData = ApplicationErrorData::noBeginTransaction(1, 1);
      }
    } else {
      $errorData = ApplicationErrorData::warningInsertData(1, 1);
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveNutritional", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ConfirmSave", $insere);

  // Return response
  $dataSvc->endOfService();
}
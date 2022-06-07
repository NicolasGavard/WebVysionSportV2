<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/FoodTypeStorData.php");
  include(__DIR__ . "/Data/FoodTypeNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/FoodTypeStor.php");
  include(__DIR__ . "/Storage/FoodTypeNameStor.php");

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($foodTypeStorData, $jsonError) = FoodTypeStorData::getJsonData($dataSvc->getParameter("data"));
    list($foodTypeNamesStorData, $jsonErrorName) = FoodTypeNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

print_r($foodTypeStorData);
print_r($foodTypeNamesStorData);

    if ($jsonError->getCode() == "") {
      if ($dbConnection->beginTransaction()) {
        $canSave = true;
        if ($foodTypeStorData->getId() == 0) {
          // Verify Code Exist
          $currentFoodTypeStorData = FoodTypeStor::findByIndCode($foodTypeStorData, $dbConnection);
          if ($currentFoodTypeStorData->getId() > 0) {
            $canSave             = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("The Code " . $foodTypeStorData->getCode() . " is already in use");
            $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
            $errorData = $distriXSvcErrorData;
          }
        }
        if ($canSave) {
          list($insere, $idFoodTypeStorData) = FoodTypeStor::save($foodTypeStorData, $dbConnection);
          if ($insere) {
            foreach ($foodTypeNamesStorData as $foodTypeNameStorData) {
              $foodTypeNameStorData->setIdFoodType($idFoodTypeStorData);
              list($insere, $idFoodTypeNameStorData) = FoodTypeNameStor::save($foodTypeNameStorData, $dbConnection);
              if (!$insere) { break; }
            }
            if (!$insere) {
              // Error with FoodTypeNames
            }
          } else {
            // Error with FoodType
          }
          if ($insere) {
            $dbConnection->commit();
          } else {
            $dbConnection->rollBack();
            if ($foodTypeStorData->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveFoodType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ConfirmSave", $insere);

  // Return response
  $dataSvc->endOfService();
}
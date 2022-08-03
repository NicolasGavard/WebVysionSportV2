<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/NutritionalStor.php");
include(__DIR__ . "/Storage/NutritionalNameStor.php");

// Database Data
include(__DIR__ . "/Data/NutritionalStorData.php");
include(__DIR__ . "/Data/NutritionalNameStorData.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($nutritionalStorData, $jsonError) = NutritionalStorData::getJsonData($dataSvc->getParameter("data"));
  list($nutritionalNamesStorData, $jsonErrorName) = NutritionalNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));
  if ($jsonError->getCode() == "") {
    if ($dbConnection->beginTransaction()) {
      $canSave = true;
      $currentNutritionalStorData = new NutritionalStorData();
      if ($nutritionalStorData->getId() == 0) {
        // Verify Code Exist
        $currentNutritionalStorData = NutritionalStor::findByCode($nutritionalStorData, $dbConnection);
        if ($currentNutritionalStorData->getId() > 0) {
          $canSave = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $nutritionalStorData->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      } else {
        // Verify no one has already modified the data
        $currentNutritionalStorData = NutritionalStor::read($nutritionalStorData->getId(), $dbConnection);
        if ($nutritionalStorData->getId() == $currentNutritionalStorData->getId() 
          && $nutritionalStorData->getTimestamp() != $currentNutritionalStorData->getTimestamp()) {
          $canSave = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("401");
          $distriXSvcErrorData->setDefaultText("The data of " . $nutritionalStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
          $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
          $errorData = $distriXSvcErrorData;
        }
      }
      if ($canSave) {
        list($currentNutritionalStorData, $listNames) = NutritionalStor::readNames($nutritionalStorData->getId(), $dbConnection);
        if (($nutritionalStorData->getId() == $currentNutritionalStorData->getId() && $nutritionalStorData->getTimestamp() == $currentNutritionalStorData->getTimestamp())
        || ($nutritionalStorData->getId() != $currentNutritionalStorData->getId())) {
          list($insere, $idNutritionalStorData) = NutritionalStor::save($nutritionalStorData, $dbConnection);
          if (!empty($listNames)) {
            foreach ($listNames as $nameStorData) {
              $notFound = true;
              foreach ($nutritionalNamesStorData as $nutritionalNameStorData) {
                $nutritionalNameStorData->setIdNutritional($idNutritionalStorData);
                if ($nutritionalNameStorData->getId() > 0 && $nutritionalNameStorData->getId() == $nameStorData->getId()) {
                  $notFound = false;
                  if ($nutritionalNameStorData->getTimestamp() != $nameStorData->getTimestamp()) {
                    $canSave = false;
                    $distriXSvcErrorData = new DistriXSvcErrorData();
                    $distriXSvcErrorData->setCode("402");
                    $distriXSvcErrorData->setDefaultText("The language data of " . $nutritionalStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
                    $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
                    $errorData = $distriXSvcErrorData;
                    break;
                  }
                }
                list($insere, $idNutritionalNameStorData) = NutritionalNameStor::save($nutritionalNameStorData, $dbConnection);
                if (!$insere) { break; }
              }
              if ($notFound) { // This language has been removed !
                  $insere = NutritionalNameStor::delete($nameStorData->getId(), $dbConnection);
                  if (!$insere) { break; }
              }
            }
          } else { // Currently no languages
            foreach ($nutritionalNamesStorData as $nutritionalNameStorData) {
              $nutritionalNameStorData->setIdNutritional($idNutritionalStorData);
              list($insere, $idNutritionalNameStorData) = NutritionalNameStor::save($nutritionalNameStorData, $dbConnection);
              if (!$insere) { break; }
            }
          }
        }
      }
      if ($canSave) {
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

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
// Database Data
include(__DIR__ . "/Data/WeightTypeNameStorData.php");
include(__DIR__ . "/Data/WeightTypeStorData.php");
// Storage
include(__DIR__ . "/Storage/WeightTypeNameStor.php");
include(__DIR__ . "/Storage/WeightTypeStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($weightTypeStorData, $jsonError) = WeightTypeStorData::getJsonData($dataSvc->getParameter("data"));
  list($weightTypeNamesStorData, $jsonErrorName) = WeightTypeNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

  if ($jsonError->getCode() == "") {
    if ($dbConnection->beginTransaction()) {
      $canSave = true;
      $currentWeightTypeStorData = new WeightTypeStorData();

      if ($weightTypeStorData->getId() == 0) {
        // Verify Code Exist
        $currentWeightTypeStorData = WeightTypeStor::findByCode($weightTypeStorData, $dbConnection);
        if ($currentWeightTypeStorData->getId() > 0) {
          $canSave = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $weightTypeStorData->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      } else {
        // Verify no one has already modified the data
        $currentWeightTypeStorData = WeightTypeStor::read($weightTypeStorData->getId(), $dbConnection);
        if ($weightTypeStorData->getId() == $currentWeightTypeStorData->getId() 
          && $weightTypeStorData->getTimestamp() != $currentWeightTypeStorData->getTimestamp()) {
          $canSave = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("401");
          $distriXSvcErrorData->setDefaultText("The data of " . $weightTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
          $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
          $errorData = $distriXSvcErrorData;
          }
      }
      if ($canSave) {
        list($currentWeightTypeStorData, $listNames) = WeightTypeStor::readNames($weightTypeStorData->getId(), $dbConnection);
        if (($weightTypeStorData->getId() == $currentWeightTypeStorData->getId() && $weightTypeStorData->getTimestamp() == $currentWeightTypeStorData->getTimestamp())
        || ($weightTypeStorData->getId() != $currentWeightTypeStorData->getId())) {
          list($insere, $idWeightTypeStorData) = WeightTypeStor::save($weightTypeStorData, $dbConnection);
          if (!empty($listNames)) {
            foreach ($listNames as $nameStorData) {
              $notFound = true;
              foreach ($weightTypeNamesStorData as $weightTypeNameStorData) {
                $weightTypeNameStorData->setIdWeightType($idWeightTypeStorData);
                if ($weightTypeNameStorData->getId() > 0 && $weightTypeNameStorData->getId() == $nameStorData->getId()) {
                  $notFound = false;
                  if ($weightTypeNameStorData->getTimestamp() != $nameStorData->getTimestamp()) {
                    $canSave = false;
                    $distriXSvcErrorData = new DistriXSvcErrorData();
                    $distriXSvcErrorData->setCode("402");
                    $distriXSvcErrorData->setDefaultText("The language data of " . $weightTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
                    $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
                    $errorData = $distriXSvcErrorData;
                    break;
                  }
                }
                list($insere, $idWeightTypeNameStorData) = WeightTypeNameStor::save($weightTypeNameStorData, $dbConnection);
                if (!$insere) { break; }
              }
              if ($notFound) { // This language has been removed !
                  $insere = WeightTypeNameStor::delete($nameStorData->getId(), $dbConnection);
                  if (!$insere) { break; }
              }
            }
          } else { // Currently no languages
            foreach ($weightTypeNamesStorData as $weightTypeNameStorData) {
              $weightTypeNameStorData->setIdWeightType($idWeightTypeStorData);
              list($insere, $idWeightTypeNameStorData) = WeightTypeNameStor::save($weightTypeNameStorData, $dbConnection);
              if (!$insere) { break; }
            }
          }
        }
      }
      if ($canSave) {
        if ($insere) {
          $dbConnection->commit();
          // $dbConnection->rollBack();
        } else {
          $dbConnection->rollBack();
          if ($weightTypeStorData->getId() > 0) {
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveWeightType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ConfirmSave", $insere && $canSave);

// Return response
$dataSvc->endOfService();
}
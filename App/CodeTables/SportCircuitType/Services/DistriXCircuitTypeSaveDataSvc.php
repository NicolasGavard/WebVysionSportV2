<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
// Database Data
include(__DIR__ . "/Data/CircuitTypeStorData.php");
include(__DIR__ . "/Data/CircuitTypeNameStorData.php");
// Storage
include(__DIR__ . "/Storage/CircuitTypeStor.php");
include(__DIR__ . "/Storage/CircuitTypeNameStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($circuitTypeStorData, $jsonError) = CircuitTypeStorData::getJsonData($dataSvc->getParameter("data"));
  list($circuitTypeNamesStorData, $jsonErrorName) = CircuitTypeNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

  if ($jsonError->getCode() == "") {
    if ($dbConnection->beginTransaction()) {
      $canSave = true;
      $currentCircuitTypeStorData = new CircuitTypeStorData();

      if ($circuitTypeStorData->getId() == 0) {
        // Verify Code Exist
        $currentCircuitTypeStorData = CircuitTypeStor::findByIndCode($circuitTypeStorData, $dbConnection);
        if ($currentCircuitTypeStorData->getId() > 0) {
          $canSave = false;
          $distriXSvcErrorData = new ApplicationErrorData("400", 1, 1);
          $distriXSvcErrorData->setDefaultText("The Code " . $circuitTypeStorData->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      } else {
        // Verify no one has already modified the data
        $currentCircuitTypeStorData = CircuitTypeStor::read($circuitTypeStorData->getId(), $dbConnection);
        if ($circuitTypeStorData->getId() == $currentCircuitTypeStorData->getId() 
          && $circuitTypeStorData->getTimestamp() != $currentCircuitTypeStorData->getTimestamp()) {
          $canSave = false;
          $distriXSvcErrorData = new ApplicationErrorData("401", 1, 1);
          $distriXSvcErrorData->setDefaultText("The data of " . $circuitTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
          $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
          $errorData = $distriXSvcErrorData;
          }
      }
      if ($canSave) {
        list($currentCircuitTypeStorData, $listNames) = CircuitTypeStor::readNames($circuitTypeStorData->getId(), $dbConnection);
        if (($circuitTypeStorData->getId() == $currentCircuitTypeStorData->getId() && $circuitTypeStorData->getTimestamp() == $currentCircuitTypeStorData->getTimestamp())
        || ($circuitTypeStorData->getId() != $currentCircuitTypeStorData->getId())) {
          list($insere, $idCircuitTypeStorData) = CircuitTypeStor::save($circuitTypeStorData, $dbConnection);
          if (!empty($listNames)) {
            foreach ($listNames as $nameStorData) {
              $notFound = true;
              foreach ($circuitTypeNamesStorData as $circuitTypeNameStorData) {
                $circuitTypeNameStorData->setIdCircuitType($idCircuitTypeStorData);
                if ($circuitTypeNameStorData->getId() > 0 && $circuitTypeNameStorData->getId() == $nameStorData->getId()) {
                  $notFound = false;
                  if ($circuitTypeNameStorData->getTimestamp() != $nameStorData->getTimestamp()) {
                    $canSave = false;
                    $distriXSvcErrorData = new ApplicationErrorData("402", 1, 1);
                    $distriXSvcErrorData->setDefaultText("The language data of " . $circuitTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
                    $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
                    $errorData = $distriXSvcErrorData;
                    break;
                  }
                }
                list($insere, $idCircuitTypeNameStorData) = CircuitTypeNameStor::save($circuitTypeNameStorData, $dbConnection);
                if (!$insere) { break; }
              }
              if ($notFound) { // This language has been removed !
                  $insere = CircuitTypeNameStor::delete($nameStorData->getId(), $dbConnection);
                  if (!$insere) { break; }
              }
            }
          } else { // Currently no languages
            foreach ($circuitTypeNamesStorData as $circuitTypeNameStorData) {
              $circuitTypeNameStorData->setIdCircuitType($idCircuitTypeStorData);
              list($insere, $idCircuitTypeNameStorData) = CircuitTypeNameStor::save($circuitTypeNameStorData, $dbConnection);
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
          if ($circuitTypeStorData->getId() > 0) {
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveCircuitType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ConfirmSave", $insere && $canSave);

// Return response
$dataSvc->endOfService();
}
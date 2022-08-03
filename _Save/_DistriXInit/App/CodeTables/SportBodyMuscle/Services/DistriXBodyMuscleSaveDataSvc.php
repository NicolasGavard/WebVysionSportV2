<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/BodyMuscleStorData.php");
include(__DIR__ . "/Data/BodyMuscleNameStorData.php");
// Storage
include(__DIR__ . "/Storage/BodyMuscleStor.php");
include(__DIR__ . "/Storage/BodyMuscleNameStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($bodyMuscleStorData, $jsonError) = BodyMuscleStorData::getJsonData($dataSvc->getParameter("data"));
  list($bodyMuscleNamesStorData, $jsonErrorName) = BodyMuscleNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

  if ($jsonError->getCode() == "") {
    if ($dbConnection->beginTransaction()) {
      $canSave = true;
      $currentBodyMuscleStorData = new BodyMuscleStorData();

      if ($bodyMuscleStorData->getId() == 0) {
        // Verify Code Exist
        $currentBodyMuscleStorData = BodyMuscleStor::findByIndCode($bodyMuscleStorData, $dbConnection);
        if ($currentBodyMuscleStorData->getId() > 0) {
          $canSave = false;
          $distriXSvcErrorData = new ApplicationErrorData("400", 1, 1);
          $distriXSvcErrorData->setDefaultText("The Code " . $bodyMuscleStorData->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      } else {
        // Verify no one has already modified the data
        $currentBodyMuscleStorData = BodyMuscleStor::read($bodyMuscleStorData->getId(), $dbConnection);
        if ($bodyMuscleStorData->getId() == $currentBodyMuscleStorData->getId() 
          && $bodyMuscleStorData->getTimestamp() != $currentBodyMuscleStorData->getTimestamp()) {
          $canSave = false;
          $distriXSvcErrorData = new ApplicationErrorData("401", 1, 1);
          $distriXSvcErrorData->setDefaultText("The data of " . $bodyMuscleStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
          $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
          $errorData = $distriXSvcErrorData;
          }
      }
      if ($canSave) {
        $currentBodyMuscleStorData = BodyMuscleStor::read($bodyMuscleStorData->getId(), $dbConnection);
        if (($bodyMuscleStorData->getId() == $currentBodyMuscleStorData->getId() && $bodyMuscleStorData->getTimestamp() == $currentBodyMuscleStorData->getTimestamp())
        || ($bodyMuscleStorData->getId() != $currentBodyMuscleStorData->getId())) {
          list($insere, $idBodyMuscleStorData) = BodyMuscleStor::save($bodyMuscleStorData, $dbConnection);
          foreach ($bodyMuscleNamesStorData as $bodyMuscleNameStorData) {
            $bodyMuscleNameStorData->setIdBodyMuscle($idBodyMuscleStorData);
            if ($bodyMuscleNameStorData->getId() > 0) {
              $currentBodyMuscleNameStorData = BodyMuscleNameStor::read($bodyMuscleNameStorData->getId(), $dbConnection);
              if ($bodyMuscleNameStorData->getId() == $currentBodyMuscleNameStorData->getId() 
              && $bodyMuscleNameStorData->getTimestamp() != $currentBodyMuscleNameStorData->getTimestamp()) {
                $canSave = false;
                $distriXSvcErrorData = new ApplicationErrorData("402", 1, 1);
                $distriXSvcErrorData->setDefaultText("The language data of " . $bodyMuscleStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
                $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
                $errorData = $distriXSvcErrorData;
                break;
              }
            }
            list($insere, $idBodyMuscleNameStorData) = BodyMuscleNameStor::save($bodyMuscleNameStorData, $dbConnection);
            if (!$insere) { break; }
          }
        }
      }
      if ($canSave) {
        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($bodyMuscleStorData->getId() > 0) {
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveBodyMuscle", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ConfirmSave", $insere && $canSave);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/BodyMemberStorData.php");
include(__DIR__ . "/Data/BodyMemberNameStorData.php");
// Storage
include(__DIR__ . "/Storage/BodyMemberStor.php");
include(__DIR__ . "/Storage/BodyMemberNameStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($bodyMemberStorData, $jsonError) = BodyMemberStorData::getJsonData($dataSvc->getParameter("data"));
  list($bodyMemberNamesStorData, $jsonErrorName) = BodyMemberNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

  if ($jsonError->getCode() == "") {
    if ($dbConnection->beginTransaction()) {
      $canSave = true;
      $currentBodyMemberStorData = new BodyMemberStorData();

      if ($bodyMemberStorData->getId() == 0) {
        // Verify Code Exist
        $currentBodyMemberStorData = BodyMemberStor::findByIndCode($bodyMemberStorData, $dbConnection);
        if ($currentBodyMemberStorData->getId() > 0) {
          $canSave = false;
          $distriXSvcErrorData = new ApplicationErrorData("400", 1, 1);
          $distriXSvcErrorData->setDefaultText("The Code " . $bodyMemberStorData->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      } else {
        // Verify no one has already modified the data
        $currentBodyMemberStorData = BodyMemberStor::read($bodyMemberStorData->getId(), $dbConnection);
        if ($bodyMemberStorData->getId() == $currentBodyMemberStorData->getId() 
          && $bodyMemberStorData->getTimestamp() != $currentBodyMemberStorData->getTimestamp()) {
          $canSave = false;
          $distriXSvcErrorData = new ApplicationErrorData("401", 1, 1);
          $distriXSvcErrorData->setDefaultText("The data of " . $bodyMemberStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
          $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
          $errorData = $distriXSvcErrorData;
          }
      }
      if ($canSave) {
        $currentBodyMemberStorData = BodyMemberStor::read($bodyMemberStorData->getId(), $dbConnection);
        if (($bodyMemberStorData->getId() == $currentBodyMemberStorData->getId() && $bodyMemberStorData->getTimestamp() == $currentBodyMemberStorData->getTimestamp())
        || ($bodyMemberStorData->getId() != $currentBodyMemberStorData->getId())) {
          list($insere, $idBodyMemberStorData) = BodyMemberStor::save($bodyMemberStorData, $dbConnection);
          foreach ($bodyMemberNamesStorData as $bodyMemberNameStorData) {
            $bodyMemberNameStorData->setIdBodyMember($idBodyMemberStorData);
            if ($bodyMemberNameStorData->getId() > 0) {
              $currentBodyMemberNameStorData = BodyMemberNameStor::read($bodyMemberNameStorData->getId(), $dbConnection);
              if ($bodyMemberNameStorData->getId() == $currentBodyMemberNameStorData->getId() 
              && $bodyMemberNameStorData->getTimestamp() != $currentBodyMemberNameStorData->getTimestamp()) {
                $canSave = false;
                $distriXSvcErrorData = new ApplicationErrorData("402", 1, 1);
                $distriXSvcErrorData->setDefaultText("The language data of " . $bodyMemberStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
                $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
                $errorData = $distriXSvcErrorData;
                break;
              }
            }
            list($insere, $idBodyMemberNameStorData) = BodyMemberNameStor::save($bodyMemberNameStorData, $dbConnection);
            if (!$insere) { break; }
          }
        }
      }
      if ($canSave) {
        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($bodyMemberStorData->getId() > 0) {
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveBodyMember", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ConfirmSave", $insere && $canSave);

// Return response
$dataSvc->endOfService();

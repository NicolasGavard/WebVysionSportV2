<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/Init/DistriXCurrentDietInitDataSvc.php");
if ($dataSvc->isAuthorized()) {
  // RestoreCurrentDiet
  if ($dataSvc->getMethodName() == "RestoreCurrentDiet") {
    $dbConnection = null;
    $errorData    = null;
    $insere       = false;
    
    $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
    if (is_null($dbConnection->getError())) {
      if ($dbConnection->beginTransaction()) {
        list($dietStorData, $jsonError) = DietStorData::getJsonData($dataSvc->getParameter("data"));
        $insere = DietStor::restore($dietStorData, $dbConnection);
        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($dietStorData->getId() > 0) {
            $errorData = ApplicationErrorData::warningUpdateData(1, 1);
          } else {
            $errorData = ApplicationErrorData::warningInsertData(1, 1);
          }
        }
      } else {
        $errorData = ApplicationErrorData::noBeginTransaction(1, 1);
      }
    } else {
      $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
    }

    if ($errorData != null) {
      $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "RestoreCurrentDiet", $dataSvc->getMethodName(), basename(__FILE__));
      $dataSvc->addErrorToResponse($errorData);
    }

    $dataSvc->addToResponse("ConfirmSave", $insere);
  }
}

// Return response
$dataSvc->endOfService();

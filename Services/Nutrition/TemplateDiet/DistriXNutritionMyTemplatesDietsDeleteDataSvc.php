<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/Init/DistriXTemplateDietInitDataSvc.php");

if ($dataSvc->isAuthorized()) {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      list($dietTemplateStorData, $jsonError) = DietTemplateStorData::getJsonData($dataSvc->getParameter("data"));
      $insere = DietTemplateStor::remove($dietTemplateStorData, $dbConnection);
      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($dietTemplateStorData->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "DelTemplateDiet", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSave", $insere);
}

// Return response
$dataSvc->endOfService();

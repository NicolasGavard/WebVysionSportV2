<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../Init/DataSvcInit.php");
if (isset($dataSvc) && !is_null($dataSvc) && $dataSvc->isAuthorized()) {
// Database Data
  include(__DIR__ . "/Data/StyUserStorData.php");
  // Storage
  include(__DIR__ . "/Storage/StyUserStor.php");

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      list($styUserstorData, $jsonError) = StyUserStorData::getJsonData($dataSvc->getParameter("data"));
      $insere = StyUserStor::remove($styUserstorData, $dbConnection);
      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        $errorData = ApplicationErrorData::warningDeleteData(1, 1);
      }
    } else {
      $errorData = ApplicationErrorData::noBeginTransaction(1, 1);
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "RestoreUser", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ConfirmSaveUser", $insere);

  // Return response
  $dataSvc->endOfService();
}

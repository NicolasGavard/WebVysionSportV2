<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/NutritionalStorData.php");
// Storage
include(__DIR__ . "/Storage/NutritionalStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    list($nutritionalStorData, $jsonError) = NutritionalStorData::getJsonData($dataSvc->getParameter("data"));
    $insere = NutritionalStor::remove($nutritionalStorData, $dbConnection);
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "DelTicketType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ConfirmSave", $insere);

// Return response
$dataSvc->endOfService();

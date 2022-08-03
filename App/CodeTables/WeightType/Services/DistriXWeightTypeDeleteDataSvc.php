<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/WeightTypeStorData.php");
// Storage
include(__DIR__ . "/Storage/WeightTypeStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    list($weightTypeStor, $jsonError) = WeightTypeStorData::getJsonData($dataSvc->getParameter("data"));
    $insere = WeightTypeStor::remove($weightTypeStor, $dbConnection);
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "DelWeightType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ConfirmSave", $insere);

// Return response
$dataSvc->endOfService();

<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// Database Data
include(__DIR__ . "/Data/ScoreNutriStorData.php");
// Storage
include(__DIR__ . "/Storage/ScoreNutriStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    list($data, $jsonError) = ScoreNutriStorData::getJsonData($dataSvc->getParameter("data"));
    $scoreNutristor           = ScoreNutriStor::read($data->getId(), $dbConnection);
    $insere                 = ScoreNutriStor::remove($scoreNutristor, $dbConnection);
    
    if ($insere) {
      $dbConnection->commit();
    } else {
      $dbConnection->rollBack();
      $errorData = ApplicationErrorData::warningUpdateData(1, 1);
    }
  } else {
    $errorData = ApplicationErrorData::noBeginTransaction(1, 1);
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}

if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "DelNutriScore", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ConfirmSave", $insere);

// Return response
$dataSvc->endOfService();

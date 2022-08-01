<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/BodyMuscleStorData.php");
include(__DIR__ . "/Data/BodyMuscleNameStorData.php");
// Storage
include(__DIR__ . "/Storage/BodyMuscleStor.php");
include(__DIR__ . "/Storage/BodyMuscleNameStor.php");

// Data
$bodyMuscle      = new BodyMuscleStorData();
$bodyMuscleNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($bodyMuscle, $jsonError)     = BodyMuscleStorData::getJsonData($dataSvc->getParameter("data"));
  list($bodyMuscle, $bodyMuscleNames) = BodyMuscleStor::readNames($bodyMuscle->getId(), $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewBodyMuscle", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewBodyMuscle", $bodyMuscle);
$dataSvc->addToResponse("ViewBodyMuscleNames", $bodyMuscleNames);

// Return response
$dataSvc->endOfService();

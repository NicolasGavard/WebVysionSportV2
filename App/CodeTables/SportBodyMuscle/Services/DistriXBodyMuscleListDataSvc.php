<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/BodyMuscleStorData.php");
include(__DIR__ . "/Data/BodyMuscleNameStorData.php");
// Storage
include(__DIR__ . "/Storage/BodyMuscleStor.php");
include(__DIR__ . "/Storage/BodyMuscleNameStor.php");

$bodyMuscles     = [];
$bodyMuscleNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($dataName, $jsonError) = BodyMuscleNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  list($bodyMuscles, $bodyMuscleNames) = BodyMuscleStor::getListNames(true, $dataName, $dbConnection);
  // list($bodyMuscles, $bodyMuscleNames) = BodyMuscleStor::getListNames(true, BodyMuscleNameStorData::getJsonData($dataSvc->getParameter("dataName"))[0], $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListBodyMuscle", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListBodyMuscles", $bodyMuscles);
$dataSvc->addToResponse("ListBodyMuscleNames", $bodyMuscleNames);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/ExerciseTypeStorData.php");
include(__DIR__ . "/Data/ExerciseTypeNameStorData.php");
// Storage
include(__DIR__ . "/Storage/ExerciseTypeStor.php");
include(__DIR__ . "/Storage/ExerciseTypeNameStor.php");

// Data
$exerciseType      = new ExerciseTypeStorData();
$exerciseTypeNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($exerciseType, $jsonError)     = ExerciseTypeStorData::getJsonData($dataSvc->getParameter("data"));
  list($exerciseType, $exerciseTypeNames) = ExerciseTypeStor::readNames($exerciseType->getId(), $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewExerciseType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewExerciseType", $exerciseType);
$dataSvc->addToResponse("ViewExerciseTypeNames", $exerciseTypeNames);

// Return response
$dataSvc->endOfService();

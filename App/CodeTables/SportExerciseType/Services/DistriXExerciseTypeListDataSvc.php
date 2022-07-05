<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/ExerciseTypeStorData.php");
include(__DIR__ . "/Data/ExerciseTypeNameStorData.php");
// Storage
include(__DIR__ . "/Storage/ExerciseTypeStor.php");
include(__DIR__ . "/Storage/ExerciseTypeNameStor.php");

$ExerciseTypes     = [];
$ExerciseTypeNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($dataName, $jsonError) = ExerciseTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  list($ExerciseTypes, $ExerciseTypeNames) = ExerciseTypeStor::getListNames(true, $dataName, $dbConnection);
  // list($ExerciseTypes, $ExerciseTypeNames) = ExerciseTypeStor::getListNames(true, ExerciseTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"))[0], $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListExerciseType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListExerciseTypes", $ExerciseTypes);
$dataSvc->addToResponse("ListExerciseTypeNames", $ExerciseTypeNames);

// Return response
$dataSvc->endOfService();

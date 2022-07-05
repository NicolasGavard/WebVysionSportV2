<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/ExerciseTypeStorData.php");
include(__DIR__ . "/Data/ExerciseTypeNameStorData.php");
// Storage
include(__DIR__ . "/Storage/ExerciseTypeStor.php");
include(__DIR__ . "/Storage/ExerciseTypeNameStor.php");

$ExerciseType      = new ExerciseTypeStorData();
$ExerciseTypeNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if (!is_null($dataSvc->getParameter("data"))) {
    list($ExerciseType, $jsonError) = ExerciseTypeStorData::getJsonData($dataSvc->getParameter("data"));
  }
  $dataName = new ExerciseTypeNameStorData();
  if (!is_null($dataSvc->getParameter("dataName"))) {
    list($dataName, $jsonError) = ExerciseTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  }
  list($ExerciseType, $ExerciseTypeNames) = ExerciseTypeStor::findByIndCodeNames($ExerciseType, $dataName, $dbConnection);
  // print_r($ExerciseTypeNamesStor);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListExerciseType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("FindExerciseType", $ExerciseType);
$dataSvc->addToResponse("FindExerciseTypeNames", $ExerciseTypeNames);

// Return response
$dataSvc->endOfService();

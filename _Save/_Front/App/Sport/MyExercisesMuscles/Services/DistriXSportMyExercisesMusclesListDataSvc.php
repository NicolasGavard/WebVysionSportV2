<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/ExerciseMuscleStor.php");
// STOR Data
include(__DIR__ . "/Data/ExerciseMuscleStorData.php");

$myExerciseMuscles  = [];
$dbConnection     = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($data, $jsonError)                           = ExerciseMuscleStorData::getJsonData($dataSvc->getParameter("data"));
  // list($exerciseMuscleStor, $exerciseMuscleStorInd) = ExerciseMuscleStor::getListFromExercisesList($data, $dbConnection);
  list($exerciseMuscleStor, $exerciseMuscleStorInd) = ExerciseMuscleStor::getList(true, $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListMyExerciseMuscles", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ListMyExerciseMuscles", $exerciseMuscleStor);

// Return response
$dataSvc->endOfService();

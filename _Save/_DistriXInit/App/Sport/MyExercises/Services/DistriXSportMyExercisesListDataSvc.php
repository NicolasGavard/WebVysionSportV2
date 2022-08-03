<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/ExerciseStor.php");
// STOR Data
include(__DIR__ . "/Data/ExerciseStorData.php");

$myExercises    = [];
$dbConnection   = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($data, $jsonError)               = ExerciseStorData::getJsonData($dataSvc->getParameter("data"));
  list($exerciseStor, $exerciseStorInd) = ExerciseStor::findByIdUserCoach($data, $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListMyExercises", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ListMyExercises", $exerciseStor);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/ExerciseMuscleStor.php");
// STOR Data
include(__DIR__ . "/Data/ExerciseMuscleStorData.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($exerciseMuscleStorData, $jsonError)   = ExerciseMuscleStorData::getJsonData($dataSvc->getParameter("data"));
  $exerciseMuscleStor                         = ExerciseMuscleStor::read($exerciseMuscleStorData->getId(), $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ViewMyCurrentExerciseMuscle", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewMyCurrentExerciseMuscle", $exerciseMuscleStor);

// Return response
$dataSvc->endOfService();

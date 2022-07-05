<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/ExerciseStor.php");
// STOR Data
include(__DIR__ . "/Data/ExerciseStorData.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($exerciseStorData, $jsonError)   = ExerciseStorData::getJsonData($dataSvc->getParameter("data"));
  $exerciseStor                         = ExerciseStor::read($exerciseStorData->getId(), $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ViewMyCurrentExercise", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewMyCurrentExercise", $exerciseStor);

// Return response
$dataSvc->endOfService();

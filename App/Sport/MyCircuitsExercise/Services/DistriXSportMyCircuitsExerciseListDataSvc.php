<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/CircuitExerciseStor.php");
// STOR Data
include(__DIR__ . "/Data/CircuitExerciseStorData.php");

$myCircuitExercises    = [];
$dbConnection   = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($data, $jsonError)               = CircuitExerciseStorData::getJsonData($dataSvc->getParameter("data"));
  list($exerciseStor, $exerciseStorInd) = CircuitExerciseStor::getList(false, $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListMyCircuitExercises", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ListMyCircuitExercises", $exerciseStor);

// Return response
$dataSvc->endOfService();

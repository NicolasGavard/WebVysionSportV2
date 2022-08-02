<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Cdn Location
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnFolderConst.php");
// Storage
include(__DIR__ . "/Storage/CircuitExerciseStor.php");
// STOR Data
include(__DIR__ . "/Data/CircuitExerciseStorData.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($exerciseStorData, $jsonError)   = CircuitExerciseStorData::getJsonData($dataSvc->getParameter("data"));
  $exerciseStor                         = CircuitExerciseStor::read($exerciseStorData->getId(), $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ViewMyCurrentCircuitExercise", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewMyCurrentCircuitExercise", $exerciseStor);

// Return response
$dataSvc->endOfService();

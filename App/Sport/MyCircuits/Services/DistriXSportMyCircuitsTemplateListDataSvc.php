<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/CircuitTemplateStor.php");
// STOR Data
include(__DIR__ . "/Data/CircuitTemplateStorData.php");

$myCircuitTemplates    = [];
$dbConnection   = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($data, $jsonError)               = CircuitTemplateStorData::getJsonData($dataSvc->getParameter("data"));
  list($exerciseStor, $exerciseStorInd) = CircuitTemplateStor::findByIdUserCoach($data, true, $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListMyCircuitTemplates", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ListMyCircuitTemplates", $exerciseStor);

// Return response
$dataSvc->endOfService();

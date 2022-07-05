<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/CircuitTypeStorData.php");
include(__DIR__ . "/Data/CircuitTypeNameStorData.php");
// Storage
include(__DIR__ . "/Storage/CircuitTypeStor.php");
include(__DIR__ . "/Storage/CircuitTypeNameStor.php");

// Data
$circuitType      = new CircuitTypeStorData();
$circuitTypeNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($circuitType, $jsonError)     = CircuitTypeStorData::getJsonData($dataSvc->getParameter("data"));
  list($circuitType, $circuitTypeNames) = CircuitTypeStor::readNames($circuitType->getId(), $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewCircuitType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewCircuitType", $circuitType);
$dataSvc->addToResponse("ViewCircuitTypeNames", $circuitTypeNames);

// Return response
$dataSvc->endOfService();

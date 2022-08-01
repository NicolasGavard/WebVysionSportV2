<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/CircuitTypeStorData.php");
include(__DIR__ . "/Data/CircuitTypeNameStorData.php");
// Storage
include(__DIR__ . "/Storage/CircuitTypeStor.php");
include(__DIR__ . "/Storage/CircuitTypeNameStor.php");

$circuitTypes     = [];
$circuitTypeNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($dataName, $jsonError) = CircuitTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  list($circuitTypes, $circuitTypeNames) = CircuitTypeStor::getListNames(true, $dataName, $dbConnection);
  // list($circuitTypes, $circuitTypeNames) = CircuitTypeStor::getListNames(true, CircuitTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"))[0], $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListCircuitType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListCircuitTypes", $circuitTypes);
$dataSvc->addToResponse("ListCircuitTypeNames", $circuitTypeNames);

// Return response
$dataSvc->endOfService();

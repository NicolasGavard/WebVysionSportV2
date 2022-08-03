<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/CircuitTypeStorData.php");
include(__DIR__ . "/Data/CircuitTypeNameStorData.php");
// Storage
include(__DIR__ . "/Storage/CircuitTypeStor.php");
include(__DIR__ . "/Storage/CircuitTypeNameStor.php");

$circuitType      = new CircuitTypeStorData();
$circuitTypeNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if (!is_null($dataSvc->getParameter("data"))) {
    list($circuitType, $jsonError) = CircuitTypeStorData::getJsonData($dataSvc->getParameter("data"));
  }
  $dataName = new CircuitTypeNameStorData();
  if (!is_null($dataSvc->getParameter("dataName"))) {
    list($dataName, $jsonError) = CircuitTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  }
  list($circuitType, $circuitTypeNames) = CircuitTypeStor::findByIndCodeNames($circuitType, $dataName, $dbConnection);
  // print_r($circuitTypeNamesStor);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListCircuitType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("FindCircuitType", $circuitType);
$dataSvc->addToResponse("FindCircuitTypeNames", $circuitTypeNames);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/WeightTypeStorData.php");
include(__DIR__ . "/Data/WeightTypeNameStorData.php");
// Storage
include(__DIR__ . "/Storage/WeightTypeStor.php");
include(__DIR__ . "/Storage/WeightTypeNameStor.php");

// Data
$weightType      = new WeightTypeStorData();
$weightTypeNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($weightType, $jsonError)     = WeightTypeStorData::getJsonData($dataSvc->getParameter("data"));
  list($weightType, $weightTypeNames) = WeightTypeStor::readNames($weightType->getId(), $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewWeightType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewWeightType", $weightType);
$dataSvc->addToResponse("ViewWeightTypeNames", $weightTypeNames);

// Return response
$dataSvc->endOfService();

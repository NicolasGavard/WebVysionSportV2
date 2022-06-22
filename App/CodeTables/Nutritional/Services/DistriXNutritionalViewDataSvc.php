<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/NutritionalStorData.php");
include(__DIR__ . "/Data/NutritionalNameStorData.php");
// Storage
include(__DIR__ . "/Storage/NutritionalStor.php");
include(__DIR__ . "/Storage/NutritionalNameStor.php");

// Data
$nutritional      = new NutritionalStorData();
$nutritionalNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($nutritional, $jsonError)        = NutritionalStorData::getJsonData($dataSvc->getParameter("data"));
  list($nutritional, $nutritionalNames) = NutritionalStor::readNames($nutritional->getId(), $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewNutritional", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewNutritional", $nutritional);
$dataSvc->addToResponse("ViewNutritionalNames", $nutritionalNames);

// Return response
$dataSvc->endOfService();


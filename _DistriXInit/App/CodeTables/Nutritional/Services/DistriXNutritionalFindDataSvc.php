<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/NutritionalStorData.php");
include(__DIR__ . "/Data/NutritionalNameStorData.php");
// Storage
include(__DIR__ . "/Storage/NutritionalStor.php");
include(__DIR__ . "/Storage/NutritionalNameStor.php");

$nutritionals     = [];
$nutritionalNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($dataName, $jsonError) = NutritionalNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  list($nutritionals, $nutritionalNames) = NutritionalStor::getListNames(true, $dataName, $dbConnection);
  // list($nutritionals, $nutritionalNames) = NutritionalStor::getListNames(true, NutritionalNameStorData::getJsonData($dataSvc->getParameter("dataName"))[0], $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListNutritional", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListNutritionals", $nutritionals);
$dataSvc->addToResponse("ListNutritionalNames", $nutritionalNames);

// Return response
$dataSvc->endOfService();
<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/WeightTypeNameStorData.php");
include(__DIR__ . "/Data/WeightTypeStorData.php");
include(__DIR__ . "/Data/LanguageStorData.php");
// Storage
include(__DIR__ . "/Storage/WeightTypeNameStor.php");
include(__DIR__ . "/Storage/WeightTypeStor.php");

$weightTypeStor = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($dataName, $jsonError)           = WeightTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  list($weightTypes, $weightTypeNames)  = WeightTypeStor::getListNames(true, $dataName, $dbConnection);

} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListWeightTypes", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListWeightTypes", $weightTypes);
$dataSvc->addToResponse("ListWeightTypeNames", $weightTypeNames);

// Return response
$dataSvc->endOfService();

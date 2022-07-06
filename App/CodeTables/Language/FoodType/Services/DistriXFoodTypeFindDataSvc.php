<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/FoodTypeStorData.php");
include(__DIR__ . "/Data/FoodTypeNameStorData.php");
// Storage
include(__DIR__ . "/Storage/FoodTypeStor.php");
include(__DIR__ . "/Storage/FoodTypeNameStor.php");

$foodType      = new FoodTypeStorData();
$foodTypeNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if (!is_null($dataSvc->getParameter("data"))) {
    list($foodType, $jsonError) = FoodTypeStorData::getJsonData($dataSvc->getParameter("data"));
  }
  $dataName = new FoodTypeNameStorData();
  if (!is_null($dataSvc->getParameter("dataName"))) {
    list($dataName, $jsonError) = FoodTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  }
  list($foodType, $foodTypeNames) = FoodTypeStor::findByIndCodeNames($foodType, $dataName, $dbConnection);
  // print_r($foodTypeNamesStor);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListFoodType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("FindFoodType", $foodType);
$dataSvc->addToResponse("FindFoodTypeNames", $foodTypeNames);

// Return response
$dataSvc->endOfService();

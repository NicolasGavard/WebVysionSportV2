<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/FoodNutritionalStor.php");
// STOR Data
include(__DIR__ . "/Data/FoodNutritionalStorData.php");

$foodNutritionalStor= [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($data, $jsonError) = FoodNutritionalStorData::getJsonData($dataSvc->getParameter("data"));
  list($foodNutritionalStor, $foodNutritionalStorInd) = FoodNutritionalStor::findByIdFood($data, true, $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListFoodNutritionals", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ListFoodNutritionals", $foodNutritionalStor);


// Return response
$dataSvc->endOfService();

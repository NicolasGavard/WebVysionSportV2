<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/FoodWeightStorData.php");
// Storage
include(__DIR__ . "/Storage/FoodWeightStor.php");
// Cdn Location
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$foodWeights  = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($foodWeightStor, $foodWeightStorInd) = FoodWeightStor::getList(true, $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListFoodWeights", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ListFoodWeights", $foodWeightStor);

// Return response
$dataSvc->endOfService();

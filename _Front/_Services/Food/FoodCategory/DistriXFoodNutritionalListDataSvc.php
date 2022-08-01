<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/FoodNutritionalStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/FoodNutritionalStor.php");

// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";

$dbConnection       = null;
$errorData          = null;
$foodNutritionals  = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($foodNutritionalStor, $foodNutritionalStorInd) = FoodNutritionalStor::getList(true, $dbConnection);
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

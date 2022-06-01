<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
if ($dataSvc->isAuthorized()) {
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/FoodTypeStorData.php");
include(__DIR__ . "/Data/FoodTypeNameStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/FoodTypeStor.php");
include(__DIR__ . "/Storage/FoodTypeNameStor.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";

$dbConnection  = null;
$errorData     = null;
$foodTypes     = [];
$foodTypeNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  // $dataName = new FoodTypeNameStorData();
  // list($dataName, $jsonError) = FoodTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  // list($foodTypes, $foodTypeNames) = FoodTypeStor::getListNames(true, $dataName, $dbConnection);
  list($foodTypes, $foodTypeNames) = FoodTypeStor::getListNames(true, FoodTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"))[0], $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListFoodType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListFoodTypes", $foodTypes);
$dataSvc->addToResponse("ListFoodTypeNames", $foodTypeNames);

// Return response
$dataSvc->endOfService();
}
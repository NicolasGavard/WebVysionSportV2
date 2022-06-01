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
  $dataName = new FoodTypeNameStorData();
  if (!is_null($dataSvc->getParameter("dataName"))) {
    list($dataName, $jsonError) = FoodTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  }
  // $dataName->setIdLanguage(1);
  // $dataName->setIdLanguage(2);
  
  list($foodTypes, $foodTypeNames) = FoodTypeStor::getListNames(true, $dataName, $dbConnection);
  // print_r($foodTypes);
  // print_r($foodTypeNames);
  
  $data = new FoodTypeStorData();
  // $dataName->setIdLanguage(1);
  $data->setCode("VIANDE");
  // $data->setCode("FEC");
  // list($foodTypes, $foodTypeNames) = FoodTypeStor::findByIndCodeNames($data, $dataName, $dbConnection);
  // print_r($foodTypeNamesStor);
  
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
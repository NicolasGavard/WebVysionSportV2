<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA GENERAL
include(__DIR__ . "/../../Data/DistriXGeneralIdData.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodFoodData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableFoodCategoryNameData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableLanguageData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableNutritionalNameData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeNameData.php");
include(__DIR__ . "/../../Data/DistriXFoodBrandData.php");
include(__DIR__ . "/../../Data/DistriXFoodLabelData.php");
include(__DIR__ . "/../../Data/DistriXFoodNutritionalData.php");
include(__DIR__ . "/../../Data/DistriXFoodEcoScoreData.php");
include(__DIR__ . "/../../Data/DistriXFoodNovaScoreData.php");
include(__DIR__ . "/../../Data/DistriXFoodNutriScoreData.php");
include(__DIR__ . "/../../Data/DistriXFoodWeightData.php");

include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeNameData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

session_start();
$resp             = array();
$listFoods        = array();
$listWeightTypes  = array();
$listBrands       = array();
$listLabels       = array();
$listEcoScores    = array();
$listNovaScores   = array();
$listNutriScores  = array();

$error            = array();
$output           = array();
$outputok         = false;
$servicesCaller   = new DistriXServicesCaller();

list($distriXFoodFoodData, $errorJson)    = DistriXFoodFoodData::getJsonData($_POST);
$infoProfil[0]['idLanguage'] = 1;
$_POST['id'] = $infoProfil[0]['idLanguage']; // NG 27-05-22 - until a solution is found
list($distriXCodeTableLanguageData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);

$foodCaller = new DistriXServicesCaller();
$foodCaller->setServiceName("DistriXServices/Food/Food/DistriXFoodListDataSvc.php");
$foodCaller->setMethodName("ListFoods");
$foodCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);
$foodCaller->addParameter("dataFood", $distriXFoodFoodData);

$weightTypeCaller = new DistriXServicesCaller();
$weightTypeCaller->setMethodName("ListWeightTypes");
$weightTypeCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);
$weightTypeCaller->setServiceName("DistriXServices/TablesCodes/WeightType/DistriXWeightTypeListDataSvc.php");

$foodBrandCaller = new DistriXServicesCaller();
$foodBrandCaller->setServiceName("DistriXServices/Food/Brand/DistriXFoodBrandListDataSvc.php");
$foodBrandCaller->setMethodName("ListBrands");

$foodLabelCaller = new DistriXServicesCaller();
$foodLabelCaller->setServiceName("DistriXServices/Food/Label/DistriXFoodLabelListDataSvc.php");
$foodLabelCaller->setMethodName("ListLabels");

$ecoScoreCaller = new DistriXServicesCaller();
$ecoScoreCaller->setServiceName("DistriXServices/Food/EcoScore/DistriXFoodEcoScoreListDataSvc.php");
$ecoScoreCaller->setMethodName("ListEcoScores");

$novaScoreCaller = new DistriXServicesCaller();
$novaScoreCaller->setServiceName("DistriXServices/Food/NovaScore/DistriXFoodNovaScoreListDataSvc.php");
$novaScoreCaller->setMethodName("ListNovaScores");

$nutriScoreCaller = new DistriXServicesCaller();
$nutriScoreCaller->setServiceName("DistriXServices/Food/NutriScore/DistriXFoodNutriScoreListDataSvc.php");
$nutriScoreCaller->setMethodName("ListNutriScores");

// Add Caller to multi caller
$svc = new DistriXSvc();
$svc->addToCall("Food", $foodCaller);
$svc->addToCall("WeightType", $weightTypeCaller);
$svc->addToCall("FoodBrand", $foodBrandCaller);
$svc->addToCall("FoodLabel", $foodLabelCaller);
$svc->addToCall("EcoScore", $ecoScoreCaller);
$svc->addToCall("EcoScore", $ecoScoreCaller);
$svc->addToCall("NovaScore", $novaScoreCaller);
$svc->addToCall("NutriScore", $nutriScoreCaller);

$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("Food");       //var_dump($output);
if ($outputok && isset($output["ListFoods"]) && is_array($output["ListFoods"])) {
  list($listFoods, $jsonError) = DistriXFoodFoodData::getJsonArray($output["ListFoods"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("WeightType"); //var_dump($output);
if ($outputok && isset($output["ListWeightTypes"]) && is_array($output["ListWeightTypes"])) {
  list($listWeightTypes, $jsonError) = DistriXCodeTableWeightTypeData::getJsonArray($output["ListWeightTypes"]);
} else {
  $error = $errorData;
}


list($outputok, $output, $errorData) = $svc->getResult("FoodBrand"); //var_dump($output);
if ($outputok && isset($output["ListBrands"]) && is_array($output["ListBrands"])) {
  if (isset($output["ListBrands"])) {
    $listBrands = $output["ListBrands"];
  }
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("FoodLabel"); //var_dump($output);
if ($outputok && isset($output["ListLabels"]) && is_array($output["ListLabels"])) {
  if (isset($output["ListLabels"])) {
    $listLabels = $output["ListLabels"];
  }
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("EcoScore"); //var_dump($output);
if ($outputok && isset($output["ListEcoScores"]) && is_array($output["ListEcoScores"])) {
  list($listEcoScores, $jsonError) = DistriXFoodEcoScoreData::getJsonArray($output["ListEcoScores"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("NovaScore"); //var_dump($output);
if ($outputok && isset($output["ListNovaScores"]) && is_array($output["ListNovaScores"])) {
  list($listNovaScores, $jsonError) = DistriXFoodNovaScoreData::getJsonArray($output["ListNovaScores"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("NutriScore"); //var_dump($output);
if ($outputok && isset($output["ListNutriScores"]) && is_array($output["ListNutriScores"])) {
  list($listNutriScores, $jsonError) = DistriXFoodNutriScoreData::getJsonArray($output["ListNutriScores"]);
} else {
  $error = $errorData;
}

$resp["ListFoods"]        = $listFoods;
$resp["ListBrands"]       = $listBrands;
$resp["ListLabels"]       = $listLabels;
$resp["ListEcoScores"]    = $listEcoScores;
$resp["ListNovaScores"]   = $listNovaScores;
$resp["ListNutriScores"]  = $listNutriScores;
$resp["ListWeightTypes"]  = $listWeightTypes;

if(!empty($error)){
  $resp["Error"]          = $error;
}

echo json_encode($resp);
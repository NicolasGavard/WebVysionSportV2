<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcBusServiceInit.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/LanguageStorData.php");

include(__DIR__ . "/Data/FoodStorData.php");
include(__DIR__ . "/Data/FoodLabelStorData.php");
include(__DIR__ . "/Data/FoodNutritionalStorData.php");
include(__DIR__ . "/Data/FoodWeightStorData.php");

include(__DIR__ . "/Data/BrandStorData.php");
include(__DIR__ . "/Data/LabelStorData.php");
include(__DIR__ . "/Data/NutritionalStorData.php");
include(__DIR__ . "/Data/ScoreEcoStorData.php");
include(__DIR__ . "/Data/ScoreNovaStorData.php");
include(__DIR__ . "/Data/ScoreNutriStorData.php");
include(__DIR__ . "/Data/WeightTypeStorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");

$foodCaller = new DistriXServicesCaller();
$foodCaller->setMethodName("ListFoods");
$foodCaller->addParameter("dataLanguage", $busSvc->getParameter("dataLanguage"));
$foodCaller->setServiceName("Food/Food/DistriXFoodListDataSvc.php");

$brandCaller = new DistriXServicesCaller();
$brandCaller->setMethodName("ListBrands");
$brandCaller->setServiceName("Food/Brand/DistriXFoodBrandListDataSvc.php");

$labelCaller = new DistriXServicesCaller();
$labelCaller->setMethodName("ListLabels");
$labelCaller->setServiceName("Food/Label/DistriXFoodLabelListDataSvc.php");

$ecoScoreCaller = new DistriXServicesCaller();
$ecoScoreCaller->setMethodName("ListEcoScores");
$ecoScoreCaller->setServiceName("Food/EcoScore/DistriXFoodEcoScoreListDataSvc.php");

$novaScoreCaller = new DistriXServicesCaller();
$novaScoreCaller->setMethodName("ListNovaScores");
$novaScoreCaller->setServiceName("Food/NovaScore/DistriXFoodNovaScoreListDataSvc.php");

$nutriScoreCaller = new DistriXServicesCaller();
$nutriScoreCaller->setMethodName("ListNutriScores");
$nutriScoreCaller->setServiceName("Food/NutriScore/DistriXFoodNutriScoreListDataSvc.php");

// Add Caller to multi caller
$svc = new DistriXSvc();
$svc->addToCall("Foods", $foodCaller);
$svc->addToCall("Brands", $brandCaller);
$svc->addToCall("Labels", $labelCaller);
$svc->addToCall("EcoScores", $ecoScoreCaller);
$svc->addToCall("NovaScores", $novaScoreCaller);
$svc->addToCall("NutriScores", $nutriScoreCaller);

$callsOk = $svc->call();

$listFoods = $listBrands = $listLabels = $listEcoScores = $listNovaScores = $listNutriScores = [];

list($outputok, $output, $errorData) = $svc->getResult("Foods"); //var_dump($output);
if ($outputok && isset($output["ListFoods"]) && is_array($output["ListFoods"])) {
  list($listFoods, $jsonError) = FoodStorData::getJsonArray($output["ListFoods"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("Brands"); //var_dump($output);
if ($outputok && isset($output["ListBrands"]) && is_array($output["ListBrands"])) {
  list($listBrands, $jsonError) = BrandStorData::getJsonArray($output["ListBrands"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("Labels"); //var_dump($output);
if ($outputok && isset($output["ListLabels"]) && is_array($output["ListLabels"])) {
  list($listLabels, $jsonError) = LabelStorData::getJsonArray($output["ListLabels"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("EcoScores"); //var_dump($output);
if ($outputok && isset($output["ListEcoScores"]) && is_array($output["ListEcoScores"])) {
  list($listEcoScores, $jsonError) = ScoreEcoStorData::getJsonArray($output["ListEcoScores"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("NovaScores"); //var_dump($output);
if ($outputok && isset($output["ListNovaScores"]) && is_array($output["ListNovaScores"])) {
  list($listNovaScores, $jsonError) = ScoreNovaStorData::getJsonArray($output["ListNovaScores"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("NutriScores"); //var_dump($output);
if ($outputok && isset($output["ListNutriScores"]) && is_array($output["ListNutriScores"])) {
  list($listNutriScores, $jsonError) = ScoreNutriStorData::getJsonArray($output["ListNutriScores"]);
} else {
  $error = $errorData;
}

$busSvc->addToResponse("ListFoods", $listFoods);
$busSvc->addToResponse("ListBrands", $listBrands);
$busSvc->addToResponse("ListLabels", $listLabels);
$busSvc->addToResponse("ListEcoScores", $listEcoScores);
$busSvc->addToResponse("ListNovaScores", $listNovaScores);
$busSvc->addToResponse("ListNutriScores", $listNutriScores);

$busSvc->endOfService();

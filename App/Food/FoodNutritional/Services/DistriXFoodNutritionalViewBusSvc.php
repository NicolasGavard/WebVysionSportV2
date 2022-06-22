<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
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

list($dataLanguage, $jsonError) = LanguageStorData::getJsonData($busSvc->getParameter("dataLanguage"));

$foodCaller = new DistriXServicesCaller();
$foodCaller->setMethodName("ListFoods");
$foodCaller->addParameter("dataLanguage", $dataLanguage);
$foodCaller->setServiceName("Food/Food/DistriXFoodListDataSvc.php");

$foodLabelCaller = new DistriXServicesCaller();
$foodLabelCaller->setMethodName("ListFoodLabels");
$foodLabelCaller->setServiceName("Food/Food/DistriXFoodLabelListDataSvc.php");

$foodNutritionalCaller = new DistriXServicesCaller();
$foodNutritionalCaller->setMethodName("ListFoodNutritionals");
$foodNutritionalCaller->setServiceName("Food/Food/DistriXFoodNutritionalListDataSvc.php");

$foodWeightTypeCaller = new DistriXServicesCaller();
$foodWeightTypeCaller->setMethodName("ListFoodWeights");
$foodWeightTypeCaller->setServiceName("Food/Food/DistriXFoodWeightListDataSvc.php");

$nutritionalCaller = new DistriXServicesCaller();
$nutritionalCaller->setMethodName("ListNutritionals");
$nutritionalCaller->addParameter("dataLanguage", $dataLanguage);
$nutritionalCaller->setServiceName("TablesCodes/Nutritional/DistriXNutritionalListDataSvc.php");

$weightTypeCaller = new DistriXServicesCaller();
$weightTypeCaller->setMethodName("ListWeightTypes");
$weightTypeCaller->addParameter("dataLanguage", $dataLanguage);
$weightTypeCaller->setServiceName("TablesCodes/WeightType/DistriXWeightTypeListDataSvc.php");

// Add Caller to multi caller
$svc = new DistriXSvc();
$svc->addToCall("Foods", $foodCaller);
$svc->addToCall("FoodLabels", $foodLabelCaller);
$svc->addToCall("FoodNutritionals", $foodNutritionalCaller);
$svc->addToCall("FoodWeights", $foodWeightTypeCaller);
$svc->addToCall("Nutritional", $nutritionalCaller);
$svc->addToCall("WeightType", $weightTypeCaller);

$callsOk = $svc->call();

$listFoods = $listFoodLabels = $listFoodNutritionals = $listFoodWeights = [];
$listBrands = $listLabels = $listEcoScores = $listNovaScores = $listNutriScores = $listNutritionals = $listWeightTypes = [];

list($outputok, $output, $errorData) = $svc->getResult("Foods");       //var_dump($output);
if ($outputok && isset($output["ListFoods"]) && is_array($output["ListFoods"])) {
  list($listFoods, $jsonError) = FoodStorData::getJsonArray($output["ListFoods"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("FoodLabels"); var_dump($output);
if ($outputok && isset($output["ListFoodLabels"]) && is_array($output["ListFoodLabels"])) {
  list($listFoodLabels, $jsonError) = FoodLabelStorData::getJsonArray($output["ListFoodLabels"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("FoodNutritionals"); //var_dump($output);
if ($outputok && isset($output["ListFoodNutritionals"]) && is_array($output["ListFoodNutritionals"])) {
  list($listFoodNutritionals, $jsonError) = FoodNutritionalStorData::getJsonArray($output["ListFoodNutritionals"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("FoodWeights"); //var_dump($output);
if ($outputok && isset($output["ListFoodWeights"]) && is_array($output["ListFoodWeights"])) {
  list($listFoodWeights, $jsonError) = FoodWeightStorData::getJsonArray($output["ListFoodWeights"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("Label"); //var_dump($output);
if ($outputok && isset($output["ListLabels"]) && is_array($output["ListLabels"])) {
  list($listLabels, $jsonError) = LabelStorData::getJsonArray($output["ListLabels"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("Nutritional"); //var_dump($output);
if ($outputok && isset($output["ListNutritionals"]) && is_array($output["ListNutritionals"])) {
  list($listNutritionals, $jsonError) = NutritionalStorData::getJsonArray($output["ListNutritionals"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("WeightType"); //var_dump($output);
if ($outputok && isset($output["ListWeightTypes"]) && is_array($output["ListWeightTypes"])) {
  list($listWeightTypes, $jsonError) = WeightTypeStorData::getJsonArray($output["ListWeightTypes"]);
} else {
  $error = $errorData;
}

echo '<br><br>Je suis la : <br>';
print_r($listFoods);
echo '<br><br>';
print_r($listFoodLabels);
echo '<br><br>';
print_r($listFoodNutritionals);
echo '<br><br>';
print_r($listFoodWeights);
die();

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListFoods");
$servicesCaller->setServiceName("Food/Food/DistriXFoodListFullDataSvc.php");
$servicesCaller->addParameter("dataFood", $listFoods);                        //print_r($listFoods);
$servicesCaller->addParameter("dataFoodLabel", $listFoodLabels);              //print_r($listFoodLabels);
$servicesCaller->addParameter("dataFoodNutritional", $listFoodNutritionals);  //print_r($listFoodNutritionals);
$servicesCaller->addParameter("dataFoodWeight", $listFoodWeights);            //print_r($listFoodWeights);
list($outputok, $output, $errorData) = $servicesCaller->call();               print_r($output);
if ($outputok && isset($output["ListFoods"]) && is_array($output["ListFoods"])) {
  list($listFoods, $jsonError) = DistriXFoodFoodData::getJsonArray($output["ListFoods"]);
} else {
  $resp["Error"]      = $errorData;
}

$busSvc->addToResponse("ListBrands", $listBrands);
$busSvc->addToResponse("ListLabels", $listLabels);
$busSvc->addToResponse("ListEcoScores", $listEcoScores);
$busSvc->addToResponse("ListNovaScores", $listNovaScores);
$busSvc->addToResponse("ListNutriScores", $listNutriScores);
$busSvc->addToResponse("ListNutritionals", $listNutritionals);
$busSvc->addToResponse("ListWeightTypes", $listWeightTypes);

$busSvc->endOfService();

<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../../CodeTables/WeightType/Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../../CodeTables/Nutritional/Data/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../Data/DistriXFoodNutritionalData.php");
include(__DIR__ . "/../Data/DistriXFoodFoodNutritionalData.php");

$resp                           = [];
$listWeights                    = [];
$listNutritionals               = [];
$listFoodNutritionals           = [];
$listNotApplyNutritionals       = [];
$listFoodNutritionalsFromFront  = [];
// $_POST['idFood']                = 1;
list($distriXFoodFoodNutritionalData, $errorJson) = DistriXFoodFoodNutritionalData::getJsonData($_POST);

// CALL
$weightTypeCaller = new DistriXServicesCaller();
$weightTypeCaller->setServiceName("App/CodeTables/WeightType/Services/DistriXWeightTypeListDataSvc.php");

$nutritionalCaller = new DistriXServicesCaller();
$nutritionalCaller->setServiceName("App/CodeTables/Nutritional/Services/DistriXNutritionalListDataSvc.php");

$foodNutritionalCaller = new DistriXServicesCaller();
$foodNutritionalCaller->setServiceName("App/Food/FoodNutritional/Services/DistriXFoodNutritionalListDataSvc.php");
$foodNutritionalCaller->addParameter("data", $distriXFoodFoodNutritionalData);

$svc = new DistriXSvc();
$svc->addToCall("weightType", $weightTypeCaller);
$svc->addToCall("nutritional", $nutritionalCaller);
$svc->addToCall("foodNutritional", $foodNutritionalCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("weightType"); //print_r($output);
if ($outputok && isset($output["ListWeightTypes"]) && is_array($output["ListWeightTypes"])) {
  list($listWeights, $jsonError) = DistriXCodeTableWeightTypeData::getJsonArray($output["ListWeightTypes"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("nutritional"); //print_r($output);
if ($outputok && isset($output["ListNutritionals"]) && is_array($output["ListNutritionals"])) {
  list($listNutritionals, $jsonError) = DistriXCodeTableWeightTypeData::getJsonArray($output["ListNutritionals"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("foodNutritional"); //print_r($output);
if ($outputok && isset($output["ListFoodNutritionals"]) && is_array($output["ListFoodNutritionals"])) {
  list($listFoodNutritionals, $jsonError) = DistriXFoodNutritionalData::getJsonArray($output["ListFoodNutritionals"]);
} else {
  $resp["Error"]      = $errorData;
}

$listNotApplyNutritionals = $listNutritionals;

foreach ($listFoodNutritionals as $foodNutritional) {
  $distriXFoodNutritionalData = new DistriXFoodNutritionalData();
  $distriXFoodNutritionalData->setId($foodNutritional->getId());
  $distriXFoodNutritionalData->setIdFood($foodNutritional->getIdFood());
  $distriXFoodNutritionalData->setIdNutritional($foodNutritional->getIdNutritional());

  foreach ($listNutritionals as $key => $nutritional) {
    if ($nutritional->getId() == $foodNutritional->getIdNutritional()){
      $distriXFoodNutritionalData->setNameNutritional($nutritional->getName());
      unset($listNotApplyNutritionals[$key]);
      break;
    }
  }

  $distriXFoodNutritionalData->setNutritional($foodNutritional->getNutritional());
  $distriXFoodNutritionalData->setIdWeightType($foodNutritional->getIdWeightType());
  $distriXFoodNutritionalData->setIdWeightTypeBase($foodNutritional->getIdWeightTypeBase());

  foreach ($listWeights as $key => $weight) {
    if ($weight->getId() == $foodNutritional->getIdWeightType()){
      $distriXFoodNutritionalData->setNameWeightType($weight->getName());
    }
    if ($weight->getId() == $foodNutritional->getIdWeightTypeBase()){
      $distriXFoodNutritionalData->setNameWeightTypeBase($weight->getName());
    }
  }

  $distriXFoodNutritionalData->setWeightTypeBase($foodNutritional->getWeightTypeBase());
  $distriXFoodNutritionalData->setElemState($foodNutritional->getElemState());
  $distriXFoodNutritionalData->setTimestamp($foodNutritional->getTimestamp());
  $listFoodNutritionalsFromFront[] = $distriXFoodNutritionalData;
}

$resp["ListNotApplyNutritionals"] = array_merge($listNotApplyNutritionals);
$resp["ListFoodNutritionals"]     = $listFoodNutritionalsFromFront;
$resp["ListNutritionals"]         = $listNutritionals;
$resp["ListWeights"]              = $listWeights;
if(!empty($error)){
  $resp["Error"]                  = $error;
}

echo json_encode($resp);
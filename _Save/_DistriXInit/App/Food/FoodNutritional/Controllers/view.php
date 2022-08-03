<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../../CodeTables/WeightType/Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../../CodeTables/Nutritional/Data/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../Data/DistriXFoodNutritionalData.php");
include(__DIR__ . "/../Data/DistriXFoodFoodNutritionalData.php");

$resp                     = [];
$listWeights              = [];
$listNutritionals         = [];
$listNotApplyNutritionals = [];
list($distriXFoodFoodNutritionalData, $errorJson) = DistriXFoodNutritionalData::getJsonData($_POST);

// CALL
$weightTypeCaller = new DistriXServicesCaller();
$weightTypeCaller->setServiceName("App/CodeTables/WeightType/Services/DistriXWeightTypeListDataSvc.php");

$nutritionalCaller = new DistriXServicesCaller();
$nutritionalCaller->setServiceName("App/CodeTables/Nutritional/Services/DistriXNutritionalListDataSvc.php");

$foodNutritionalCaller = new DistriXServicesCaller();
$foodNutritionalCaller->setServiceName("App/Food/FoodNutritional/Services/DistriXFoodNutritionalViewDataSvc.php");
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
  list($listNutritionals, $jsonError) = DistriXCodeTableNutritionalData::getJsonArray($output["ListNutritionals"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("foodNutritional"); //print_r($output);
if ($outputok && isset($output["FoodNutritionals"]) && is_array($output["FoodNutritionals"])) {
  list($distriXFoodFoodNutritionalData, $jsonError) = DistriXFoodNutritionalData::getJsonData($output["FoodNutritionals"]);

  $listNotApplyNutritionals = $listNutritionals;
  foreach ($listNutritionals as $key => $nutritional) {
    if ($nutritional->getId() == $distriXFoodFoodNutritionalData->getIdNutritional()){
      $distriXFoodFoodNutritionalData->setNameNutritional($nutritional->getName());
      unset($listNotApplyNutritionals[$key]);
      break;
    }
  }
  
  foreach ($listWeights as $key => $weight) {
    if ($weight->getId() == $distriXFoodFoodNutritionalData->getIdWeightType()){
      $distriXFoodFoodNutritionalData->setNameWeightType($weight->getName());
    }
    if ($weight->getId() == $distriXFoodFoodNutritionalData->getIdWeightTypeBase()){
      $distriXFoodFoodNutritionalData->setNameWeightTypeBase($weight->getName());
    }
  }
} else {
  $resp["Error"]      = $errorData;
}

$resp["FoodNutritional"]          = $distriXFoodFoodNutritionalData;
$resp["ListNotApplyNutritionals"] = array_merge($listNotApplyNutritionals);
$resp["ListNutritionals"]         = $listNutritionals;
$resp["ListWeights"]              = $listWeights;
if(!empty($error)){
  $resp["Error"]                  = $error;
}

echo json_encode($resp);
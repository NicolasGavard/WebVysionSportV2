<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../../CodeTables/WeightType/Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../Data/DistriXFoodFoodWeightData.php");

$resp                      = [];
$listWeights               = [];
$listFoodWeights           = [];
$listNotApplyWeights       = [];
$listFoodWeightsFromFront  = [];
list($distriXFoodFoodWeightData, $errorJson) = DistriXFoodFoodWeightData::getJsonData($_POST);

// CALL
$weightTypeCaller = new DistriXServicesCaller();
$weightTypeCaller->setServiceName("App/CodeTables/WeightType/Services/DistriXWeightTypeListDataSvc.php");

$foodWeightCaller = new DistriXServicesCaller();
$foodWeightCaller->setServiceName("App/Food/FoodWeight/Services/DistriXFoodWeightListDataSvc.php");
$foodWeightCaller->addParameter("data", $distriXFoodFoodWeightData);

$svc = new DistriXSvc();
$svc->addToCall("weightType", $weightTypeCaller);
$svc->addToCall("foodWeight", $foodWeightCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("weightType"); //print_r($output);
if ($outputok && isset($output["ListWeightTypes"]) && is_array($output["ListWeightTypes"])) {
  list($listWeights, $jsonError) = DistriXCodeTableWeightTypeData::getJsonArray($output["ListWeightTypes"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("foodWeight"); //print_r($output);
if ($outputok && isset($output["ListFoodWeights"]) && is_array($output["ListFoodWeights"])) {
  list($listFoodWeights, $jsonError) = DistriXFoodFoodWeightData::getJsonArray($output["ListFoodWeights"]);
} else {
  $resp["Error"]      = $errorData;
}

$listNotApplyWeights = $listWeights;

foreach ($listFoodWeights as $foodWeight) {
  foreach ($listWeights as $key => $weightType) {
    if ($weightType->getId() == $foodWeight->getIdWeightType()){
      $distriXFoodWeightData = new DistriXFoodFoodWeightData();
      $distriXFoodWeightData->setId($foodWeight->getId());
      $distriXFoodWeightData->setIdFood($foodWeight->getIdFood());
      $distriXFoodWeightData->setIdWeightType($foodWeight->getIdWeightType());
      $distriXFoodWeightData->setNameWeightType($weightType->getName());
      $distriXFoodWeightData->setWeight($foodWeight->getWeight());
      $distriXFoodWeightData->setLinkToPicture($foodWeight->getLinkToPicture());
      $distriXFoodWeightData->setElemState($foodWeight->getElemState());
      $distriXFoodWeightData->setTimestamp($foodWeight->getTimestamp());
      $listFoodWeightsFromFront[] = $distriXFoodWeightData;
      
      unset($listNotApplyWeights[$key]);
      break;
    }
  }
}

$resp["ListNotApplyWeights"] = array_merge($listNotApplyWeights);
$resp["ListFoodWeights"]     = $listFoodWeightsFromFront;
$resp["ListWeights"]         = $listWeights;
if(!empty($error)){
  $resp["Error"]            = $error;
}

echo json_encode($resp);
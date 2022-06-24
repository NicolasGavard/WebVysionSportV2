<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../../CodeTables/WeightType/Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../Data/DistriXFoodFoodWeightData.php");

$resp        = [];
$listWeights = [];
$foodWeights = [];

$_POST['id']  = 12;

list($distriXFoodFoodWeightData, $errorJson) = DistriXFoodFoodWeightData::getJsonData($_POST);

// CALL
$weightTypeCaller = new DistriXServicesCaller();
$weightTypeCaller->setServiceName("App/CodeTables/WeightType/Services/DistriXWeightTypeListDataSvc.php");

$foodWeightCaller = new DistriXServicesCaller();
$foodWeightCaller->setServiceName("App/Food/FoodWeight/Services/DistriXFoodWeightViewDataSvc.php");
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

list($outputok, $output, $errorData) = $svc->getResult("foodWeight"); print_r($output);
if ($outputok && isset($output["FoodWeights"]) && is_array($output["FoodWeights"])) {
  list($foodWeights, $jsonError) = DistriXFoodFoodWeightData::getJsonData($output["FoodWeights"]);
} else {
  $resp["Error"]      = $errorData;
}

$resp["FoodWeights"]  = $foodWeights;
$resp["ListWeights"]  = $listWeights;
if(!empty($error)){
  $resp["Error"]      = $error;
}

echo json_encode($resp);
<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodNutritionalData.php");
include(__DIR__ . "/../Data/DistriXFoodFoodNutritionalData.php");

$resp                           = [];
$listNutritionals               = [];
$listFoodNutritionals           = [];
$listNotApplyNutritionals       = [];
$listFoodNutritionalsFromFront  = [];
$_POST['id']                    = 1;
list($distriXFoodFoodNutritionalData, $errorJson) = DistriXFoodFoodNutritionalData::getJsonData($_POST);

// CALL
$nutritionalCaller = new DistriXServicesCaller();
$nutritionalCaller->setServiceName("App/CodeTables/Nutritional/Services/DistriXNutritionalListDataSvc.php");

$foodNutritionalCaller = new DistriXServicesCaller();
$foodNutritionalCaller->setServiceName("App/Food/FoodNutritional/Services/DistriXFoodNutritionalListDataSvc.php");
$foodNutritionalCaller->addParameter("data", $distriXFoodFoodNutritionalData);

$svc = new DistriXSvc();
$svc->addToCall("nutritional", $nutritionalCaller);
$svc->addToCall("foodNutritional", $foodNutritionalCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("nutritional"); //print_r($output);
if ($outputok && isset($output["ListNutritionals"]) && is_array($output["ListNutritionals"])) {
  list($listNutritionals, $jsonError) = DistriXFoodNutritionalData::getJsonArray($output["ListNutritionals"]);
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
      
      $distriXFoodNutritionalData->setNameNutritional($nutritional->getNameNutritional());
      unset($listNotApplyNutritionals[$key]);
      break;
    }
  }


  $distriXFoodNutritionalData->setNutritional($foodNutritional->getNutritional());
  $distriXFoodNutritionalData->setIdWeightType($foodNutritional->getIdWeightType());
  $distriXFoodNutritionalData->setNameWeightType($foodNutritional->getNameWeightType());
  $distriXFoodNutritionalData->setIdWeightTypeBase($foodNutritional->getIdWeightTypeBase());
  $distriXFoodNutritionalData->setNameWeightTypeBase($foodNutritional->getNameWeightTypeBase());
  $distriXFoodNutritionalData->setWeightTypeBase($foodNutritional->getWeightTypeBase());
  $distriXFoodNutritionalData->setElemState($foodNutritional->getElemState());
  $distriXFoodNutritionalData->setTimestamp($foodNutritional->getTimestamp());
  $listFoodNutritionalsFromFront[] = $distriXFoodNutritionalData;
  
  
}

$resp["ListNotApplyNutritionals"] = array_merge($listNotApplyNutritionals);
$resp["ListFoodNutritionals"]     = $listFoodNutritionalsFromFront;
$resp["ListNutritionals"]         = $listNutritionals;
if(!empty($error)){
  $resp["Error"]            = $error;
}

echo json_encode($resp);
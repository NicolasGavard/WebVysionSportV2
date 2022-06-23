<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodNutritionalData.php");
include(__DIR__ . "/../Data/DistriXFoodFoodNutritionalData.php");

$resp                     = [];
$listFoodNutritionals           = [];
$listFoodNutritionalsFromFront  = [];
list($distriXFoodFoodNutritionalData, $errorJson) = DistriXFoodFoodNutritionalData::getJsonData($_POST);

// CALL
$labelCaller = new DistriXServicesCaller();
$labelCaller->setServiceName("App/Food/Nutritional/Services/DistriXFoodlabelListDataSvc.php");

$foodNutritionalCaller = new DistriXServicesCaller();
$foodNutritionalCaller->setServiceName("App/Food/FoodNutritional/Services/DistriXFoodNutritionalListDataSvc.php");
$foodNutritionalCaller->addParameter("data", $distriXFoodFoodNutritionalData);

$svc = new DistriXSvc();
$svc->addToCall("label", $labelCaller);
$svc->addToCall("foodNutritional", $foodNutritionalCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("label"); //print_r($output);
if ($outputok && isset($output["ListNutritionals"]) && is_array($output["ListNutritionals"])) {
  list($listNutritionals, $jsonError) = DistriXFoodNutritionalData::getJsonArray($output["ListNutritionals"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("foodNutritional"); //print_r($output);
if ($outputok && isset($output["ListFoodNutritionals"]) && is_array($output["ListFoodNutritionals"])) {
  list($listFoodNutritionals, $jsonError) = DistriXFoodFoodNutritionalData::getJsonArray($output["ListFoodNutritionals"]);
} else {
  $resp["Error"]      = $errorData;
}

$listNotApplyNutritionals = $listNutritionals;

foreach ($listFoodNutritionals as $foodNutritional) {
  foreach ($listNutritionals as $key => $label) {
    if ($label->getId() == $foodNutritional->getIdNutritional()){
      $distriXFoodNutritionalData = new DistriXFoodNutritionalData();
      $distriXFoodNutritionalData->setId($label->getId());
      $distriXFoodNutritionalData->setCode($label->getCode());
      $distriXFoodNutritionalData->setName($label->getName());
      $distriXFoodNutritionalData->setLinkToPicture($label->getLinkToPicture());
      $distriXFoodNutritionalData->setElemState($label->getElemState());
      $distriXFoodNutritionalData->setTimestamp($label->getTimestamp());
      $listFoodNutritionalsFromFront[] = $distriXFoodNutritionalData;
      
      unset($listNotApplyNutritionals[$key]);
      break;
    }
  }
}

$resp["ListNotApplyNutritionals"] = array_merge($listNotApplyNutritionals);
$resp["ListFoodNutritionals"]     = $listFoodNutritionalsFromFront;
$resp["ListNutritionals"]         = $listNutritionals;
if(!empty($error)){
  $resp["Error"]            = $error;
}

echo json_encode($resp);
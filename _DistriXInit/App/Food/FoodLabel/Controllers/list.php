<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodLabelData.php");
include(__DIR__ . "/../Data/DistriXFoodFoodLabelData.php");

$resp                     = [];
$listLabels               = [];
$listFoodLabels           = [];
$listNotApplyLabels       = [];
$listFoodLabelsFromFront  = [];
list($distriXFoodFoodLabelData, $errorJson) = DistriXFoodFoodLabelData::getJsonData($_POST);

// CALL
$labelCaller = new DistriXServicesCaller();
$labelCaller->setServiceName("App/Food/Label/Services/DistriXFoodlabelListDataSvc.php");

$foodLabelCaller = new DistriXServicesCaller();
$foodLabelCaller->setServiceName("App/Food/FoodLabel/Services/DistriXFoodLabelListDataSvc.php");
$foodLabelCaller->addParameter("data", $distriXFoodFoodLabelData);

$svc = new DistriXSvc();
$svc->addToCall("label", $labelCaller);
$svc->addToCall("foodLabel", $foodLabelCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("label"); //print_r($output);
if ($outputok && isset($output["ListLabels"]) && is_array($output["ListLabels"])) {
  list($listLabels, $jsonError) = DistriXFoodLabelData::getJsonArray($output["ListLabels"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("foodLabel"); //print_r($output);
if ($outputok && isset($output["ListFoodLabels"]) && is_array($output["ListFoodLabels"])) {
  list($listFoodLabels, $jsonError) = DistriXFoodFoodLabelData::getJsonArray($output["ListFoodLabels"]);
} else {
  $resp["Error"]      = $errorData;
}

$listNotApplyLabels = $listLabels;

foreach ($listFoodLabels as $foodLabel) {
  foreach ($listLabels as $key => $label) {
    if ($label->getId() == $foodLabel->getIdLabel()){
      $distriXFoodLabelData = new DistriXFoodLabelData();
      $distriXFoodLabelData->setId($label->getId());
      $distriXFoodLabelData->setCode($label->getCode());
      $distriXFoodLabelData->setName($label->getName());
      $distriXFoodLabelData->setLinkToPicture($label->getLinkToPicture());
      $distriXFoodLabelData->setElemState($foodLabel->getElemState());
      $distriXFoodLabelData->setTimestamp($foodLabel->getTimestamp());
      $listFoodLabelsFromFront[] = $distriXFoodLabelData;
      
      unset($listNotApplyLabels[$key]);
      break;
    }
  }
}

$resp["ListNotApplyLabels"] = array_merge($listNotApplyLabels);
$resp["ListFoodLabels"]     = $listFoodLabelsFromFront;
$resp["ListLabels"]         = $listLabels;
if(!empty($error)){
  $resp["Error"]            = $error;
}

echo json_encode($resp);
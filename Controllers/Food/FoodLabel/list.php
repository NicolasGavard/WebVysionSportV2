<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Food/DistriXFoodLabelData.php");

$resp           = [];
$listFoodLabels = [];
list($distriXFoodLabelData, $errorJson) = DistriXFoodLabelData::getJsonData($_POST);
// CALL
$labelCaller = new DistriXServicesCaller();
$labelCaller->setServiceName("Food/Label/DistriXFoodlabelListDataSvc.php");
$labelCaller->addParameter("data", $distriXFoodLabelData);

$svc = new DistriXSvc();
$svc->addToCall("label", $labelCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("label"); //print_r($output);
if ($outputok && isset($output["ListLabels"]) && is_array($output["ListLabels"])) {
  list($listFoodLabels, $jsonError) = DistriXFoodLabelData::getJsonArray($output["ListLabels"]);
} else {
  $resp["Error"]      = $errorData;
}

$resp["ListFoodLabels"]        = $listFoodLabels;
if(!empty($error)){
  $resp["Error"]          = $error;
}

echo json_encode($resp);
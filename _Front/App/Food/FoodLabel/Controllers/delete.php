<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodLabelData.php");
include(__DIR__ . "/../Data/DistriXFoodFoodLabelData.php");

$confirmSave  = false;

list($distriXFoodLabelData, $errorJson) = DistriXFoodLabelData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $distriXFoodLabelData);
$servicesCaller->setServiceName("App/Food/FoodLabel/Services/DistriXFoodLabelDeleteDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Food", "DistriXFoodLabelDeleteDataSvc", "DelFoodLabel", $output);

if ($outputok && !empty($output) && isset($output["ConfirmSave"])) {
  $confirmSave = $output["ConfirmSave"];
} else {
  $error = $errorData;
}

$resp["ConfirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
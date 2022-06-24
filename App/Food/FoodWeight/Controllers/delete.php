<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodWeightData.php");

$confirmSave  = false;

list($distriXFoodWeightData, $errorJson) = DistriXFoodWeightData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("DelFoodWeight");
$servicesCaller->addParameter("data", $distriXFoodWeightData);
$servicesCaller->setServiceName("Food/FoodWeight/DistriXFoodWeightDeleteDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Food", "DistriXFoodWeightDeleteDataSvc", "DelFoodWeight", $output);

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
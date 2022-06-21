<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodFoodData.php");

$confirmSave  = false;

list($distriXFoodFoodData, $errorJson) = DistriXFoodFoodData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("DelFood");
$servicesCaller->addParameter("data", $distriXFoodFoodData);
$servicesCaller->setServiceName("Food/Food/DistriXFoodDeleteDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Food", "DistriXBrandDeleteDataSvc", "DelFood", $output);

if ($outputok && !empty($output) && isset($output["ConfirmSave"])) {
  $confirmSave = $output["ConfirmSave"];
} else {
  $error = $errorData;
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
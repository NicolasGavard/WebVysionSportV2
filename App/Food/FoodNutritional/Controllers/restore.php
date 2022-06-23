<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodNutritionalData.php");

$confirmSave  = false;

list($distriXFoodNutritionalData, $errorJson) = DistriXFoodNutritionalData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("RestoreFoodNutritional");
$servicesCaller->addParameter("data", $distriXFoodNutritionalData);
$servicesCaller->setServiceName("Food/FoodNutritional/DistriXFoodNutritionalRestoreDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Food", "DistriXFoodNutritionalRestoreDataSvc", "RestoreFoodNutritional", $output);

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
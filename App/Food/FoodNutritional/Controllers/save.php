<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodNutritionalData.php");

list($distriXFoodNutritionalData, $errorJson) = DistriXFoodNutritionalData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $distriXFoodNutritionalData);
$servicesCaller->setServiceName("App/Food/FoodNutritional/Services/DistriXFoodSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Food", "DistriXBrandSaveDataSvc", "SaveFood", $output);

if ($outputok && isset($output["ConfirmSave"]) && $output["ConfirmSave"]) {
  $confirmSave = $output["ConfirmSave"];
} else {
  $error = $errorData;
}

$resp["ConfirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodFoodWeightData.php");

$confirmSave = false;

list($distriXFoodFoodWeightData, $errorJson) = DistriXFoodFoodWeightData::getJsonData($_POST);
if($_POST['base64Img'] != '') { $distriXFoodFoodWeightData->setLinkToPicture($_POST['base64Img']);}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $distriXFoodFoodWeightData);
$servicesCaller->setServiceName("App/Food/FoodWeight/Services/DistriXFoodWeightSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Food", "DistriXFoodWeightSaveDataSvc", "SaveFood", $output);

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
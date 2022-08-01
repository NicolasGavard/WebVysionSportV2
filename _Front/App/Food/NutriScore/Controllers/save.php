<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodNutriScoreData.php");

$confirmSave  = false;
if($_POST["base64Img"] != ''){
  $_POST["linkToPicture"] = $_POST["base64Img"];
}
list($distriXFoodNutriScoreData, $errorJson) = DistriXFoodNutriScoreData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $distriXFoodNutriScoreData);
$servicesCaller->setServiceName("App/Food/NutriScore/Services/DistriXFoodNutriScoreSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_NutriScore", "DistriXNutriScoreSaveDataSvc", "SaveNutriScore", $output);

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
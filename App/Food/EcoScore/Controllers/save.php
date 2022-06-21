<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodEcoScoreData.php");

$confirmSave  = false;

if ($_POST["base64Img"] != '') {
  $_POST["linkToPicture"] = $_POST["base64Img"];
}
list($distriXFoodEcoScoreData, $errorJson) = DistriXFoodEcoScoreData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveEcoScore");
$servicesCaller->addParameter("data", $distriXFoodEcoScoreData);
$servicesCaller->setServiceName("Food/EcoScore/DistriXFoodEcoScoreSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_EcoScore", "DistriXEcoScoreSaveDataSvc", "SaveEcoScore", $output);

if ($outputok && isset($output["ConfirmSave"]) && $output["ConfirmSave"]) {
  $confirmSave = $output["ConfirmSave"];
} else {
  $error = $errorData;
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
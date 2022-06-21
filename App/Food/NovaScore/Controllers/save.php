<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodNovaScoreData.php");

$confirmSave  = false;
if ($_POST["base64Img"] != '') {
  $_POST["linkToPicture"] = $_POST["base64Img"];
}
list($distriXFoodNovaScoreData, $errorJson) = DistriXFoodNovaScoreData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveNovaScore");
$servicesCaller->addParameter("data", $distriXFoodNovaScoreData);
$servicesCaller->setServiceName("Food/NovaScore/DistriXFoodNovaScoreSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_NovaScore", "DistriXNovaScoreSaveDataSvc", "SaveNovaScore", $output);

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
<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodEcoScoreData.php");

$confirmSave  = false;

list($distriXFoodEcoScoreData, $errorJson) = DistriXFoodEcoScoreData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("RestoreEcoScore");
$servicesCaller->addParameter("data", $distriXFoodEcoScoreData);
$servicesCaller->setServiceName("Food/EcoScore/DistriXFoodEcoScoreRestoreDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_EcoScore", "DistriXFoodEcoScoreRestoreDataSvc", "RestoreEcoScore", $output);

if ($outputok && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
} else {
  $error = $errorData;
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
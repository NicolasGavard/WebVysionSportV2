<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodNutriScoreData.php");

$confirmSave  = false;
list($distriXFoodNutriScoreData, $errorJson) = DistriXFoodNutriScoreData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("RestoreNutriScore");
$servicesCaller->addParameter("data", $distriXFoodNutriScoreData);
$servicesCaller->setServiceName("Food/NutriScore/DistriXFoodNutriScoreRestoreDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_NutriScore", "DistriXFoodNutriScoreRestoreDataSvc", "RestoreNutriScore", $output);

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
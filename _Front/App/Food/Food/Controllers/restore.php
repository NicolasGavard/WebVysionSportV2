<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodFoodData.php");

$confirmSave  = false;

list($distriXFoodFoodData, $errorJson) = DistriXFoodFoodData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("RestoreFood");
$servicesCaller->addParameter("data", $distriXFoodFoodData);
$servicesCaller->setServiceName("App/Food/Food/Services/DistriXFoodRestoreDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Food", "DistriXBrandRestoreDataSvc", "RestoreFood", $output);

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
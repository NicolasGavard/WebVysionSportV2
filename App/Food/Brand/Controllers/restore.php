<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodBrandData.php");

$confirmSave  = false;

list($distriXFoodBandData, $errorJson) = DistriXFoodBrandData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("RestoreBrand");
$servicesCaller->addParameter("data", $distriXFoodBandData);
$servicesCaller->setServiceName("Food/Brand/DistriXFoodBrandRestoreDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Brand", "DistriXFoodBrandRestoreDataSvc", "RestoreBrand", $output);

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
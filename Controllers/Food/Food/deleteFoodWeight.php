<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodWeightData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp         = array();
$confirmSave  = false;
$error        = array();
$output       = array();
$outputok     = false;

$label  = new DistriXFoodWeightData();
if ($_POST['id'] > 0) {
  $label->setId($_POST['id']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("DelFoodWeight");
$servicesCaller->addParameter("data", $label);
$servicesCaller->setServiceName("DistriXServices/Food/Food/DistriXFoodWeightDeleteDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Weight")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXFoodWeightDeleteDataSvc");
  $logInfoData->setLogFunction("DelFoodWeight");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  }
} else {
  $error = $errorData;
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
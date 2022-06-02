<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodLabelData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp              = array();
$error             = array();
$output            = array();
$outputok          = false;

list($distriXFoodBandData, $errorJson) = DistriXFoodLabelData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewLabel");
$servicesCaller->addParameter("data", $distriXFoodBandData);
$servicesCaller->setServiceName("Services/Food/Label/DistriXFoodLabelViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Label")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXLabelViewDataSvc");
  $logInfoData->setLogFunction("ViewLabel");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && isset($output["ViewLabel"])) {
  $distriXFoodBandData = $output["ViewLabel"];
} else {
  $error = $errorData;
}

$resp["ViewLabel"]  = $distriXFoodBandData;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
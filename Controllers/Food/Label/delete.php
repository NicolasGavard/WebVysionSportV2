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

$resp         = [];
$confirmSave  = false;
$error        = [];
$output       = [];
$outputok     = false;

if (isset($_POST)) {
  list($distriXFoodBandData, $errorJson) = DistriXFoodLabelData::getJsonData($_POST);
  
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setMethodName("DelLabel");
  $servicesCaller->addParameter("data", $distriXFoodBandData);
  $servicesCaller->setServiceName("Food/Label/DistriXFoodLabelDeleteDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
  
  if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Label")) {
    $logInfoData = new DistriXLoggerInfoData();
    $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
    $logInfoData->setLogApplication("DistriXFoodLabelDeleteDataSvc");
    $logInfoData->setLogFunction("DelLabel");
    $logInfoData->setLogData(print_r($output, true));
    DistriXLogger::log($logInfoData);
  }
  
  if ($outputok && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodLabelData.php");

$confirmSave  = false;

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
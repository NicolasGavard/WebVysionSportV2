<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodLabelData.php");

list($distriXFoodLabelData, $errorJson) = DistriXFoodLabelData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $distriXFoodLabelData);
$servicesCaller->setServiceName("App/Food/Label/Services/DistriXFoodLabelViewDataSvc.php");
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
  $distriXFoodLabelData = $output["ViewLabel"];
} else {
  $error = $errorData;
}

$resp["ViewLabel"]  = $distriXFoodLabelData;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
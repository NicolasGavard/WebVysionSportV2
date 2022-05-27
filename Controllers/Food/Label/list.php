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

$resp           = [];
$listLabels     = [];
$error          = [];
$output         = [];
$outputok       = false;

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListLabels");
$servicesCaller->setServiceName("DistriXServices/Food/Label/DistriXFoodLabelListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Label")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXLabelListDataSvc");
  $logInfoData->setLogFunction("ListLabels");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && isset($output["ListLabels"]) && is_array($output["ListLabels"])) {
  list($listLabels, $jsonError) = DistriXFoodLabelData::getJsonArray($output["ListLabels"]);
} else {
  $error              = $errorData;
  $resp["Error"]      = $error;
}

$resp["ListLabels"]   = $listLabels;

echo json_encode($resp);
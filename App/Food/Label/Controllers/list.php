<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodLabelData.php");

$listLabels     = [];
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setServiceName("App/Food/Label/Services/DistriXFoodLabelListDataSvc.php");
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
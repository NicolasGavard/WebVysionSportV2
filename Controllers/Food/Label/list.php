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

$resp        = array();
$listLabels  = array();
$error       = array();
$output      = array();
$outputok    = false;

$distriXFoodlabelData = new DistriXFoodlabelData();
$distriXFoodlabelData->setStatus($_POST['status']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListLabels");
$servicesCaller->setServiceName("DistriXServices/Food/Label/DistriXFoodLabelListDataSvc.php");
$servicesCaller->addParameter("data", $distriXFoodlabelData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Label")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXLabelListDataSvc");
  $logInfoData->setLogFunction("ListLabels");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ListLabels"])) {
    $listLabels = $output["ListLabels"];
  }
} else {
  $error = $errorData;
}

$resp["ListLabels"]  = $listLabels;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
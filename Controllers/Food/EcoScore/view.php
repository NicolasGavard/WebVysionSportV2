<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodEcoScoreData.php");
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

list($distriXFoodEcoScoreData, $errorJson) = DistriXFoodEcoScoreData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewEcoScore");
$servicesCaller->addParameter("data", $distriXFoodEcoScoreData);
$servicesCaller->setServiceName("Food/EcoScore/DistriXFoodEcoScoreViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_EcoScore")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXEcoScoreViewDataSvc");
  $logInfoData->setLogFunction("ViewEcoScore");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && isset($output["ViewEcoScore"])) {
  $distriXFoodEcoScoreData = $output["ViewEcoScore"];
} else {
  $error = $errorData;
}

$resp["ViewEcoScore"]  = $distriXFoodEcoScoreData;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
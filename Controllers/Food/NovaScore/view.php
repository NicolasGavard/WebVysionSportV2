<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodScoreNovaData.php");
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

$scoreNova  = new DistriXFoodScoreNovaData();
if ($_POST['id'] > 0) {
  $scoreNova->setId($_POST['id']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewScoresNova");
$servicesCaller->addParameter("data", $scoreNova);
$servicesCaller->setServiceName("DistriXServices/Food/ScoreNova/DistriXFoodScoreNovaViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_ScoreNova")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXScoreNovaViewDataSvc");
  $logInfoData->setLogFunction("ViewScoresNova");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewScoreNova"])) {
    $scoreNova = $output["ViewScoreNova"];
  }
} else {
  $error = $errorData;
}

$resp["ViewNovaScore"]  = $scoreNova;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
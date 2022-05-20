<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodScoreNutriData.php");
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

$scoreNutri  = new DistriXFoodScoreNutriData();
if ($_POST['id'] > 0) {
  $scoreNutri->setId($_POST['id']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewScoresNutri");
$servicesCaller->addParameter("data", $scoreNutri);
$servicesCaller->setServiceName("DistriXServices/Food/ScoreNutri/DistriXFoodScoreNutriViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_ScoreNutri")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXScoreNutriViewDataSvc");
  $logInfoData->setLogFunction("ViewScoresNutri");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewScoreNutri"])) {
    $scoreNutri = $output["ViewScoreNutri"];
  }
} else {
  $error = $errorData;
}

$resp["ViewNutriScore"]  = $scoreNutri;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
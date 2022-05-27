<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodScoreEcoData.php");
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

$scoreEco  = new DistriXFoodScoreEcoData();
if ($_POST['id'] > 0) {
  $scoreEco->setId($_POST['id']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewScoresEco");
$servicesCaller->addParameter("data", $scoreEco);
$servicesCaller->setServiceName("DistriXServices/Food/ScoreEco/DistriXFoodScoreEcoViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_ScoreEco")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXScoreEcoViewDataSvc");
  $logInfoData->setLogFunction("ViewScoresEco");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewScoreEco"])) {
    $scoreEco = $output["ViewScoreEco"];
  }
} else {
  $error = $errorData;
}

$resp["ViewEcoScore"]  = $scoreEco;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
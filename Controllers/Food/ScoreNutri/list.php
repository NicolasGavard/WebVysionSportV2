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

$resp           = array();
$listScoresNutri  = array();
$error          = array();
$output         = array();
$outputok       = false;
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListScoresNutri");
$servicesCaller->setServiceName("DistriXServices/Food/ScoreNutri/DistriXFoodScoreNutriListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_ScoreNutri")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXScoreNutriListDataSvc");
  $logInfoData->setLogFunction("ListScoresNutri");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ListScoresNutri"])) {
    $listScoresNutri = $output["ListScoresNutri"];
  }
} else {
  $error = $errorData;
}

$resp["ListScoresNutri"]  = $listScoresNutri;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
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

$resp           = array();
$listScoresEco  = array();
$error          = array();
$output         = array();
$outputok       = false;

$distriXFoodScoreEcoData = new DistriXFoodScoreEcoData();
$distriXFoodScoreEcoData->setStatus($_POST['status']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListScoresEco");
$servicesCaller->addParameter("data", $distriXFoodScoreEcoData);
$servicesCaller->setServiceName("DistriXServices/Food/ScoreEco/DistriXFoodScoreEcoListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_ScoreEco")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXScoreEcoListDataSvc");
  $logInfoData->setLogFunction("ListScoresEco");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ListScoresEco"])) {
    $listScoresEco = $output["ListScoresEco"];
  }
} else {
  $error = $errorData;
}

$resp["ListScoresEco"]  = $listScoresEco;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
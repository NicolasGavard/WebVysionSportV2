<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodNutriScoreData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp           = [];
$listNutriScores     = [];
$error          = [];
$output         = [];
$outputok       = false;

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListNutriScores");
$servicesCaller->setServiceName("Services/Food/NutriScore/DistriXFoodNutriScoreListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_NutriScore")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXNutriScoreListDataSvc");
  $logInfoData->setLogFunction("ListNutriScores");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && isset($output["ListNutriScores"]) && is_array($output["ListNutriScores"])) {
  list($listNutriScores, $jsonError) = DistriXFoodNutriScoreData::getJsonArray($output["ListNutriScores"]);
} else {
  $error              = $errorData;
  $resp["Error"]      = $error;
}

$resp["ListNutriScores"]   = $listNutriScores;

echo json_encode($resp);
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

$resp         = array();
$confirmSave  = false;
$error        = array();
$output       = array();
$outputok     = false;

$distriXCodeTableScoreNovaData = new DistriXFoodScoreNovaData();
$distriXCodeTableScoreNovaData->setId($_POST['id']);
$distriXCodeTableScoreNovaData->setNumber($_POST['code']);
$distriXCodeTableScoreNovaData->setColor($_POST['color']);
$distriXCodeTableScoreNovaData->setDescription($_POST['description']);
$distriXCodeTableScoreNovaData->setLinkToPicture('');
if($_POST['linkToPictureBase64'] != '') { $distriXCodeTableScoreNovaData->setLinkToPicture($_POST['linkToPictureBase64']);}
$distriXCodeTableScoreNovaData->setTimestamp($_POST['timestamp']);
$distriXCodeTableScoreNovaData->setStatus($_POST['statut']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveScoreNova");
$servicesCaller->addParameter("data", $distriXCodeTableScoreNovaData);
$servicesCaller->setServiceName("DistriXServices/Food/ScoreNova/DistriXFoodScoreNovaSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_ScoreNova")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXScoreNovaSaveDataSvc");
  $logInfoData->setLogFunction("SaveScoreNova");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  }
} else {
  $error = $errorData;
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
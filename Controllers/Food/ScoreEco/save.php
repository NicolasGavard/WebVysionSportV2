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

$resp         = array();
$confirmSave  = false;
$error        = array();
$output       = array();
$outputok     = false;

$distriXCodeTableScoreEcoData = new DistriXFoodScoreEcoData();
$distriXCodeTableScoreEcoData->setId($_POST['id']);
$distriXCodeTableScoreEcoData->setLetter($_POST['code']);
$distriXCodeTableScoreEcoData->setColor($_POST['color']);
$distriXCodeTableScoreEcoData->setDescription($_POST['description']);
$distriXCodeTableScoreEcoData->setLinkToPicture('');
if($_POST['linkToPictureBase64'] != '') { $distriXCodeTableScoreEcoData->setLinkToPicture($_POST['linkToPictureBase64']);}
$distriXCodeTableScoreEcoData->setTimestamp($_POST['timestamp']);
$distriXCodeTableScoreEcoData->setStatus($_POST['statut']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveScoreEco");
$servicesCaller->addParameter("data", $distriXCodeTableScoreEcoData);
$servicesCaller->setServiceName("DistriXServices/Food/ScoreEco/DistriXFoodScoreEcoSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_ScoreEco")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXScoreEcoSaveDataSvc");
  $logInfoData->setLogFunction("SaveScoreEco");
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
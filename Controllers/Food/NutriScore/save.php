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

$resp         = array();
$confirmSave  = false;
$error        = array();
$output       = array();
$outputok     = false;

$distriXCodeTableScoreNutriData = new DistriXFoodScoreNutriData();
$distriXCodeTableScoreNutriData->setId($_POST['id']);
$distriXCodeTableScoreNutriData->setLetter($_POST['code']);
$distriXCodeTableScoreNutriData->setColor($_POST['color']);
$distriXCodeTableScoreNutriData->setDescription($_POST['description']);
$distriXCodeTableScoreNutriData->setLinkToPicture('');
if($_POST['linkToPictureBase64'] != '') { $distriXCodeTableScoreNutriData->setLinkToPicture($_POST['linkToPictureBase64']);}
$distriXCodeTableScoreNutriData->setTimestamp($_POST['timestamp']);
$distriXCodeTableScoreNutriData->setStatus($_POST['statut']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveScoreNutri");
$servicesCaller->addParameter("data", $distriXCodeTableScoreNutriData);
$servicesCaller->setServiceName("DistriXServices/Food/ScoreNutri/DistriXFoodScoreNutriSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_ScoreNutri")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXScoreNutriSaveDataSvc");
  $logInfoData->setLogFunction("SaveScoreNutri");
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
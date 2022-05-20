<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodLabelData.php");
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

$distriXCodeTableLabelData = new DistriXFoodLabelData();
$distriXCodeTableLabelData->setId($_POST['id']);
$distriXCodeTableLabelData->setCode($_POST['code']);
$distriXCodeTableLabelData->setName($_POST['name']);
$distriXCodeTableLabelData->setLinkToPicture('');
if($_POST['linkToPictureBase64'] != '') { $distriXCodeTableLabelData->setLinkToPicture($_POST['linkToPictureBase64']);}
$distriXCodeTableLabelData->setTimestamp($_POST['timestamp']);
$distriXCodeTableLabelData->setStatus($_POST['statut']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveLabel");
$servicesCaller->addParameter("data", $distriXCodeTableLabelData);
$servicesCaller->setServiceName("DistriXServices/Food/Label/DistriXFoodLabelSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Label")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXLabelSaveDataSvc");
  $logInfoData->setLogFunction("SaveLabel");
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
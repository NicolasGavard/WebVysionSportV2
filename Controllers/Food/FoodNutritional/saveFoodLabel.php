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

$distriXFoodLabelData = new DistriXFoodLabelData();
$distriXFoodLabelData->setId($_POST['id']);
$distriXFoodLabelData->setIdFood($_POST['idFood']);
$distriXFoodLabelData->setIdLabelType($_POST['idLabelType']);
$distriXFoodLabelData->setLabel($_POST['weight']);
$distriXFoodLabelData->setLinkToPicture('');
if($_POST['linkToPictureBase64'] != '') { $distriXFoodLabelData->setLinkToPicture($_POST['linkToPictureBase64']);}
$distriXFoodLabelData->setStatus($_POST['statut']);
$distriXFoodLabelData->setTimestamp($_POST['timestamp']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveFoodLabel");
$servicesCaller->addParameter("data", $distriXFoodLabelData);
$servicesCaller->setServiceName("Food/Food/DistriXFoodLabelSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Label")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXLabelSaveDataSvc");
  $logInfoData->setLogFunction("SaveFoodLabel");
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
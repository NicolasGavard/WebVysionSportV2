<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodBrandData.php");
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

$distriXCodeTableBrandData = new DistriXFoodBrandData();
$distriXCodeTableBrandData->setId($_POST['id']);
$distriXCodeTableBrandData->setName($_POST['name']);
$distriXCodeTableBrandData->setLinkToPicture('');
if($_POST['base64Img'] != '') { $distriXCodeTableBrandData->setLinkToPicture($_POST['base64Img']);}
$distriXCodeTableBrandData->setTimestamp($_POST['timestamp']);
$distriXCodeTableBrandData->setStatus($_POST['statut']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveBrand");
$servicesCaller->addParameter("data", $distriXCodeTableBrandData);
$servicesCaller->setServiceName("Food/Brand/DistriXFoodBrandSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Brand")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXBrandSaveDataSvc");
  $logInfoData->setLogFunction("SaveBrand");
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

$resp["ConfirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
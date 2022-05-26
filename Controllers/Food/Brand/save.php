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

list($distriXFoodBandData, $errorJson) = DistriXFoodBrandData::getJsonData($_POST);
if($_POST['base64Img'] != '') { $distriXFoodBandData->setLinkToPicture($_POST['base64Img']);}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveBrand");
$servicesCaller->addParameter("data", $distriXFoodBandData);
$servicesCaller->setServiceName("DistriXServices/Food/Brand/DistriXFoodBrandSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Brand")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXBrandSaveDataSvc");
  $logInfoData->setLogFunction("SaveBrand");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && isset($output["ConfirmSave"]) && is_array($output["ConfirmSave"])) {
  list($confirmSave, $jsonError) = DistriXFoodBrandData::getJsonArray($output["ConfirmSave"]);
} else {
  $error = $errorData;
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
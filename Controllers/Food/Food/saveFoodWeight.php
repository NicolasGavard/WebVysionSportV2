<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodWeightData.php");
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

$distriXFoodWeightData = new DistriXFoodWeightData();
$distriXFoodWeightData->setId($_POST['id']);
$distriXFoodWeightData->setIdFood($_POST['idFood']);
$distriXFoodWeightData->setIdWeightType($_POST['idWeightType']);
$distriXFoodWeightData->setWeight($_POST['weight']);
$distriXFoodWeightData->setLinkToPicture('');
if($_POST['linkToPictureBase64'] != '') { $distriXFoodWeightData->setLinkToPicture($_POST['linkToPictureBase64']);}
$distriXFoodWeightData->setStatus($_POST['statut']);
$distriXFoodWeightData->setTimestamp($_POST['timestamp']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveFoodWeight");
$servicesCaller->addParameter("data", $distriXFoodWeightData);
$servicesCaller->setServiceName("DistriXServices/Food/Food/DistriXFoodWeightSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Weight")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXWeightSaveDataSvc");
  $logInfoData->setLogFunction("SaveFoodWeight");
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
<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXNutritionCurrentDietData.php");
include(__DIR__ . "/../../Data/DistriXNutritionCurrentDietUsersData.php");
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


$distriXNutritionCurrentDietData = new DistriXNutritionCurrentDietData();
$distriXNutritionCurrentDietData->setId($_POST['id']);
$distriXNutritionCurrentDietData->setIdUser($_POST['id']);
$distriXNutritionCurrentDietData->setIdDietTemplace($_POST['id']);
$distriXNutritionCurrentDietData->setDateStart($_POST['dateStart']);
$distriXNutritionCurrentDietData->setStatus($_POST['statut']);
$distriXNutritionCurrentDietData->setTimestamp($_POST['timestamp']);


$distriXCodeTableDietData = new DistriXFoodDietData();
$distriXCodeTableDietData->setId($_POST['id']);
$distriXCodeTableDietData->setName($_POST['name']);
$distriXCodeTableDietData->setLinkToPicture('');
if($_POST['base64Img'] != '') { $distriXCodeTableDietData->setLinkToPicture($_POST['base64Img']);}
$distriXCodeTableDietData->setTimestamp($_POST['timestamp']);
$distriXCodeTableDietData->setStatus($_POST['statut']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveDiet");
$servicesCaller->addParameter("data", $distriXCodeTableDietData);
$servicesCaller->setServiceName("DistriXServices/Food/Diet/DistriXFoodDietSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Diet")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXDietSaveDataSvc");
  $logInfoData->setLogFunction("SaveDiet");
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
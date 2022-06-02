<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyCurrentsDiets/DistriXNutritionCurrentDietData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp              = array();
$error             = array();
$output            = array();
$outputok          = false;

$currentDiet = new DistriXNutritionCurrentDietData();
$currentDiet->setId($_POST['id'] ?? 0);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewMyCurrentDiet");
$servicesCaller->addParameter("data", $currentDiet);
$servicesCaller->setServiceName("DistriXServices/Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_MyCurrentDiet")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXMyCurrentDietViewDataSvc");
  $logInfoData->setLogFunction("ViewMyCurrentDiet");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && isset($output["ViewMyCurrentDiet"])) {
  list($currentDiet, $jsonError) = DistriXNutritionCurrentDietData::getJsonData($output["ViewMyCurrentDiet"]);
} else {
  $error = $errorData;
}

$resp["ViewMyCurrentDiet"]  = $currentDiet;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
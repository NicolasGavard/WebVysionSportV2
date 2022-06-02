<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/DistriXNutritionCurrentDietData.php");
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

$label  = new DistriXNutritionCurrentDietData();
if ($_POST['id'] > 0) {
  $label->setId($_POST['id']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewMyCurrentDiet");
$servicesCaller->addParameter("data", $label);
$servicesCaller->setServiceName("DistriXServices/Food/MyCurrentDiet/DistriXFoodMyCurrentDietViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_MyCurrentDiet")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXMyCurrentDietViewDataSvc");
  $logInfoData->setLogFunction("ViewMyCurrentDiet");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewMyCurrentDiet"])) {
    $label = $output["ViewMyCurrentDiet"];
  }
} else {
  $error = $errorData;
}

$resp["ViewMyCurrentDiet"]  = $label;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
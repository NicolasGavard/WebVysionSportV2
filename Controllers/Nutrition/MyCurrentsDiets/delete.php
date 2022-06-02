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

$resp         = array();
$confirmSave  = false;
$error        = array();
$output       = array();
$outputok     = false;

if (isset($_POST)) {
  $currentDiet = new DistriXNutritionCurrentDietData();
  $currentDiet->setId($_POST['id'] ?? 0);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setMethodName("DelCurrentDiet");
  $servicesCaller->addParameter("data", $currentDiet);
  $servicesCaller->setServiceName("Services/Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsDeleteDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
  
  if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_CurrentDiet")) {
    $logInfoData = new DistriXLoggerInfoData();
    $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
    $logInfoData->setLogApplication("DistriXCurrentDietDeleteDataSvc");
    $logInfoData->setLogFunction("DelCurrentDiet");
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
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
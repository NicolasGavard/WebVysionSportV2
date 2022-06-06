<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/Data/DistriXCodeTableMealTypeData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp        = [];
$confirmSave = false;
$error       = [];
$output      = [];
$outputok    = false;

$foodType = new DistriXCodeTableMealTypeData();
$foodType->setId($_POST['id'] ?? 0);

$foodType->setId(1);
// $foodType->setId(3);
// $foodType->setId(4);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $foodType);
$servicesCaller->setServiceName("TablesCodes/MealType/DistriXMealTypeRestoreDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); print_r($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_MealType")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXMealTypeRestoreDataSvc");
  $logInfoData->setLogFunction("DelMealType");
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

$resp["confirmSave"] = $confirmSave;
if(!empty($error)){
  $resp["Error"] = $error;
}

echo json_encode($resp);
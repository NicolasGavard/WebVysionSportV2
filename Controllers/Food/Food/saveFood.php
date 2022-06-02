<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodFoodData.php");
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

$distriXFoodData = new DistriXFoodFoodData();
$distriXFoodData->setId($_POST['id']);
$distriXFoodData->setIdBrand($_POST['idBrand']);
$distriXFoodData->setIdScoreNutri($_POST['idScroreNutri']);
$distriXFoodData->setIdScoreNova($_POST['idScroreNova']);
$distriXFoodData->setIdScoreEco($_POST['idScroreEco']);
$distriXFoodData->setCode($_POST['code']);
$distriXFoodData->setName($_POST['name']);
$distriXFoodData->setDescription($_POST['description']);
$distriXFoodData->setStatus($_POST['statut']);
$distriXFoodData->setTimestamp($_POST['timestamp']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveFood");
$servicesCaller->addParameter("data", $distriXCodeTableData);
$servicesCaller->setServiceName("Services/Food/DistriXFoodSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXSaveDataSvc");
  $logInfoData->setLogFunction("Save");
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
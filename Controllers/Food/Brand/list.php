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

$resp           = [];
$listBrands     = [];
$error          = [];
$output         = [];
$outputok       = false;

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListBrands");
$servicesCaller->setServiceName("Food/Brand/DistriXFoodBrandListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Brand")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXBrandListDataSvc");
  $logInfoData->setLogFunction("ListBrands");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && isset($output["ListBrands"]) && is_array($output["ListBrands"])) {
  list($listBrands, $jsonError) = DistriXFoodBrandData::getJsonArray($output["ListBrands"]);
} else {
  $error              = $errorData;
  $resp["Error"]      = $error;
}

$resp["ListBrands"]   = $listBrands;

echo json_encode($resp);
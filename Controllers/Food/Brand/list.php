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

$resp           = array();
$listBrands     = array();
$error          = array();
$output         = array();
$outputok       = false;

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListBrands");
$servicesCaller->setServiceName("DistriXServices/Food/Brand/DistriXFoodBrandListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Brand")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXBrandListDataSvc");
  $logInfoData->setLogFunction("ListBrands");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

print_r($output["ListBrands"]);

if ($outputok && isset($output["ListBrands"]) && is_array($output["ListBrands"])) {
  // list($listBrands, $jsonError) = DistriXFoodBrandData::getJsonArray($output["ListBrands"]);
  $resp["ListBrands"] = $output["ListBrands"]; // A tester !
} else {
  $resp["ListBrands"] = [];
  $error              = $errorData;
  $resp["Error"]      = $error;
}
echo json_encode($resp);
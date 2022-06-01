<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
// include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/Data/DistriXCodeTableFoodTypeData.php");
include(__DIR__ . "/Data/DistriXCodeTableFoodTypeNameData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp       = [];
$error      = [];
$output     = [];
$outputok   = false;

$foodType = new DistriXCodeTableFoodTypeData();
$foodType->setId($_POST['id'] ?? 0);

$foodType->setId(1);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $foodType);
$servicesCaller->setServiceName("DistriXServices/TablesCodes/FoodType/DistriXFoodTypeViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); print_r($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_FoodCategory")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXFoodTypeViewDataSvc");
  $logInfoData->setLogFunction("ViewFoodType");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}
if ($outputok && isset($output["ViewFoodType"])) {
  list($foodType, $jsonError) = DistriXCodeTableFoodTypeData::getJsonData($output["ViewFoodType"]);
} else {
  $error = $errorData;
}
if ($outputok && isset($output["ViewFoodTypeNames"]) && is_array($output["ViewFoodTypeNames"])) {
  list($listFoodTypeNames, $jsonError) = DistriXCodeTableFoodTypeNameData::getJsonArray($output["ViewFoodTypeNames"]);
  $foodType->setNames($listFoodTypeNames);
} else {
  $error = $errorData;
}
$resp["ViewFoodType"] = $foodType;
if (!empty($error)) {
  $resp["Error"] = $error;
}

echo json_encode($resp);
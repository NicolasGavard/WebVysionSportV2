<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/MealType/DistriXCodeTableMealTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/MealType/DistriXCodeTableMealTypeNameData.php");
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

// DATA
$foodType = new DistriXCodeTableMealTypeData();
$foodType->setId($_POST['id'] ?? 0);

$foodType->setId(1);
// $foodType->setId(3);
// $foodType->setId(4);

$listMealTypeNames = [];

// CALL
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $foodType);
$servicesCaller->setServiceName("TablesCodes/MealType/DistriXMealTypeViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_MealCategory")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXMealTypeViewDataSvc");
  $logInfoData->setLogFunction("ViewMealType");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

// RESPONSE
if ($outputok && isset($output["ViewMealType"])) {
  list($foodType, $jsonError) = DistriXCodeTableMealTypeData::getJsonData($output["ViewMealType"]);
} else {
  $error = $errorData;
}
if ($outputok && isset($output["ViewMealTypeNames"]) && is_array($output["ViewMealTypeNames"])) {
  list($listMealTypeNames, $jsonError) = DistriXCodeTableMealTypeNameData::getJsonArray($output["ViewMealTypeNames"]);
} else {
  $error = $errorData;
}

// TREATMENT
$foodType->setNames($listMealTypeNames);
$foodType->setNbLanguages(count($listMealTypeNames));

$resp["ViewMealType"] = $foodType;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
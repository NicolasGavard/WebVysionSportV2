<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/FoodCategory/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/../../Data/CodeTables/FoodCategory/DistriXCodeTableFoodCategoryNameData.php");
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
$foodCategory = new DistriXCodeTableFoodCategoryData();
$foodCategory->setId($_POST['id'] ?? 0);

$foodCategory->setId(1);
// $foodCategory->setId(3);
// $foodCategory->setId(4);

$listFoodCategoryNames = [];

// CALL
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $foodCategory);
$servicesCaller->setServiceName("TablesCodes/FoodCategory/DistriXFoodCategoryViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_FoodCategory")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXFoodCategoryViewDataSvc");
  $logInfoData->setLogFunction("ViewFoodCategory");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

// RESPONSE
if ($outputok && isset($output["ViewFoodCategory"])) {
  list($foodCategory, $jsonError) = DistriXCodeTableFoodCategoryData::getJsonData($output["ViewFoodCategory"]);
} else {
  $error = $errorData;
}
if ($outputok && isset($output["ViewFoodCategoryNames"]) && is_array($output["ViewFoodCategoryNames"])) {
  list($listFoodCategoryNames, $jsonError) = DistriXCodeTableFoodCategoryNameData::getJsonArray($output["ViewFoodCategoryNames"]);
} else {
  $error = $errorData;
}

// TREATMENT
$foodCategory->setNames($listFoodCategoryNames);
$foodCategory->setNbLanguages(count($listFoodCategoryNames));

$resp["ViewFoodCategory"] = $foodCategory;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
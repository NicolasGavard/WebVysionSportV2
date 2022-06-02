<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyLanguageData.php");
include(__DIR__ . "/../../Data/DistriXGeneralIdData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableFoodCategoryNameData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp               = array();
$error              = array();
$output             = array();
$outputok           = false;

$listLanguages      = DistriXStyLanguage::listLanguages();

$foodCategory       = new DistriXCodeTableFoodCategoryNameData();
if ($_POST['id'] > 0) {
  $foodCategory->setId($_POST['id']);
  $foodCategory->setIdCategory($_POST['idCategory']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewFoodCategory");
$servicesCaller->addParameter("data", $foodCategory);
$servicesCaller->setServiceName("Services/TablesCodes/FoodCategory/DistriXFoodCategoryViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_FoodCategory")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXFoodCategoryViewDataSvc");
  $logInfoData->setLogFunction("ViewFoodCategory");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewFoodCategory"])) {
    $foodCategory = $output["ViewFoodCategory"];
  }
} else {
  $error = $errorData;
}

$resp["ViewFoodCategory"] = $foodCategory;
$resp["ListLanguages"]  = $listLanguages;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
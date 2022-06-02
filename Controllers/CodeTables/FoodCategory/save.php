<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
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

$resp         = array();
$confirmSave  = false;
$error        = array();
$output       = array();
$outputok     = false;

$distriXCodeTableFoodCategoryData = new DistriXCodeTableFoodCategoryNameData();
$distriXCodeTableFoodCategoryData->setId($_POST['id']);
$distriXCodeTableFoodCategoryData->setIdCategory($_POST['idFoodCategory']);
$distriXCodeTableFoodCategoryData->setIdLanguage($_POST['idLanguage']);
$distriXCodeTableFoodCategoryData->setCode($_POST['code']);
$distriXCodeTableFoodCategoryData->setName($_POST['name']);
$distriXCodeTableFoodCategoryData->setStatus($_POST['statut']);
$distriXCodeTableFoodCategoryData->setTimestamp($_POST['timestamp']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveFoodCategory");
$servicesCaller->addParameter("data", $distriXCodeTableFoodCategoryData);
$servicesCaller->setServiceName("Services/TablesCodes/FoodCategory/DistriXFoodCategorySaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_FoodCategory")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXFoodCategorySaveDataSvc");
  $logInfoData->setLogFunction("SaveFoodCategory");
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
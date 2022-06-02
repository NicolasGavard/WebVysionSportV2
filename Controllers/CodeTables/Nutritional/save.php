<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../Data/DistriXGeneralIdData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableNutritionalNameData.php");
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

$distriXCodeTableNutritionalData = new DistriXCodeTableNutritionalNameData();
$distriXCodeTableNutritionalData->setId($_POST['id']);
$distriXCodeTableNutritionalData->setIdNutritional($_POST['idNutritional']);
$distriXCodeTableNutritionalData->setIdLanguage($_POST['idLanguage']);
$distriXCodeTableNutritionalData->setCode($_POST['code']);
$distriXCodeTableNutritionalData->setName($_POST['name']);
$distriXCodeTableNutritionalData->setStatus($_POST['statut']);
$distriXCodeTableNutritionalData->setTimestamp($_POST['timestamp']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveNutritional");
$servicesCaller->addParameter("data", $distriXCodeTableNutritionalData);
$servicesCaller->setServiceName("TablesCodes/Nutritional/DistriXNutritionalSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Nutritional")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXNutritionalSaveDataSvc");
  $logInfoData->setLogFunction("SaveNutritional");
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
<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyLanguageData.php");
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

$resp               = array();
$error              = array();
$output             = array();
$outputok           = false;

$listLanguages      = DistriXStyLanguage::listLanguages();

$weightType         = new DistriXCodeTableNutritionalNameData();
if ($_POST['id'] > 0) {
  $weightType->setId($_POST['id']);
  $weightType->setIdNutritional($_POST['idNutritional']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewScoresNutri");
$servicesCaller->addParameter("data", $weightType);
$servicesCaller->setServiceName("Services/TablesCodes/Nutritional/DistriXNutritionalViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Nutritional")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXNutritionalViewDataSvc");
  $logInfoData->setLogFunction("ViewScoresNutri");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewNutritional"])) {
    $weightType = $output["ViewNutritional"];
  }
} else {
  $error = $errorData;
}

$resp["ViewNutritional"] = $weightType;
$resp["ListLanguages"]   = $listLanguages;
if(!empty($error)){
  $resp["Error"]         = $error;
}

echo json_encode($resp);
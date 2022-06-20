<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/WeightType/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/WeightType/DistriXCodeTableWeightTypeNameData.php");
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");
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

$weightType         = new DistriXCodeTableWeightTypeNameData();
if ($_POST['id'] > 0) {
  $weightType->setId($_POST['id']);
  $weightType->setIdWeightType($_POST['idWeightType']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewScoresNutri");
$servicesCaller->addParameter("data", $weightType);
$servicesCaller->setServiceName("TablesCodes/WeightType/DistriXWeightTypeViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_WeightType")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXWeightTypeViewDataSvc");
  $logInfoData->setLogFunction("ViewScoresNutri");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewWeightType"])) {
    $weightType = $output["ViewWeightType"];
  }
} else {
  $error = $errorData;
}

$resp["ViewWeightType"] = $weightType;
$resp["ListLanguages"]  = $listLanguages;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyLanguageData.php");
include(__DIR__ . "/../../Data/DistriXGeneralIdData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeNameData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

session_start();
$resp           = array();
$listLanguages  = array();
$listWeightType = array();
$error          = array();
$output         = array();
$outputok       = false;

// $listLanguages        = DistriXStyLanguage::listLanguages();
$infoProfil[0]['idLanguage'] = 1;
$_POST['id'] = $infoProfil[0]['idLanguage']; // NG 27-05-22 - until a solution is found
list($distriXStyLanguageData, $errorJson) = DistriXStyLanguageData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListWeightType");
$servicesCaller->addParameter("data", $distriXStyLanguageData);
$servicesCaller->setServiceName("DistriXServices/TablesCodes/WeightType/DistriXWeightTypeListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_WeightType")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXWeightTypeListDataSvc");
  $logInfoData->setLogFunction("ListWeightType");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && isset($output["ListWeightType"]) && is_array($output["ListWeightType"])) {
  list($listWeightType, $jsonError) = DistriXCodeTableWeightTypeNameData::getJsonArray($output["ListWeightType"]);
} else {
  $error = $errorData;
}

$resp["ListWeightType"]   = $listWeightType;
$resp["ListLanguages"]    = $listLanguages;
if(!empty($error)){
  $resp["Error"]          = $error;
}

echo json_encode($resp);
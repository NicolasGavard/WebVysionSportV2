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

$resp           = array();
$listNutritional = array();
$error          = array();
$output         = array();
$outputok       = false;

session_start();
$infoProfil           = DistriXStyAppInterface::getUserInformation();
$distriXGeneralIdData = new DistriXGeneralIdData();
$distriXGeneralIdData->setId($infoProfil->getIdLanguage());

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListNutritional");
$servicesCaller->addParameter("dataLanguage", $distriXGeneralIdData);
$servicesCaller->setServiceName("DistriXServices/TablesCodes/Nutritional/DistriXNutritionalListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Nutritional")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXNutritionalListDataSvc");
  $logInfoData->setLogFunction("ListNutritional");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ListNutritional"])) {
    $listNutritional = $output["ListNutritional"];
  }
} else {
  $error = $errorData;
}

$resp["ListNutritional"]  = $listNutritional;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
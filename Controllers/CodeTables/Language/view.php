<?php
include(__DIR__ . "/../../Init/DistriXControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");

list($distriXCodeTableBandData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewLanguage");
$servicesCaller->addParameter("data", $distriXCodeTableBandData);
$servicesCaller->setServiceName("TablesCodes/Language/DistriXLanguageViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Language")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXLanguageViewDataSvc");
  $logInfoData->setLogFunction("ViewLanguage");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && isset($output["ViewLanguage"])) {
  $distriXCodeTableBandData = $output["ViewLanguage"];
} else {
  $error = $errorData;
}

$resp["ViewLanguage"]  = $distriXCodeTableBandData;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
<?php
include(__DIR__ . "/../../Init/DistriXControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");

$listLanguages  = [];

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListLanguages");
$servicesCaller->setServiceName("TablesCodes/Language/DistriXLanguageListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Language")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXLanguageListDataSvc");
  $logInfoData->setLogFunction("ListLanguages");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
  list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
} else {
  $error              = $errorData;
  $resp["Error"]      = $error;
}

$resp["ListLanguages"]   = $listLanguages;

echo json_encode($resp);
<?php
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");

$confirmSave  = false;

if (isset($_POST)) {
  list($distriXCodeTableBandData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);
  
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setMethodName("DelLanguage");
  $servicesCaller->addParameter("data", $distriXCodeTableBandData);
  $servicesCaller->setServiceName("TablesCodes/Language/DistriXLanguageDeleteDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
  
  $logOk = logController("Security_Language", "DistriXLanguageDeleteDataSvc", "DelLanguage", $output);

  // if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Language")) {
  //   $logInfoData = new DistriXLoggerInfoData();
  //   $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  //   $logInfoData->setLogApplication("DistriXLanguageDeleteDataSvc");
  //   $logInfoData->setLogFunction("DelLanguage");
  //   $logInfoData->setLogData(print_r($output, true));
  //   DistriXLogger::log($logInfoData);
  // }
  
  if ($outputok && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
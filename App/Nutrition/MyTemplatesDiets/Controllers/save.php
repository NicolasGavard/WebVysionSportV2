<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXNutritionTemplateDietData.php");

$confirmSave  = false;
list($distriXNutritionTemplatetDietData, $errorJson)  = DistriXNutritionTemplateDietData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setServiceName("App/Nutrition/MyTemplatesDiets/Services/DistriXNutritionMyTemplatesDietsSaveDataSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionTemplatetDietData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Diet")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXDietSaveDataSvc");
  $logInfoData->setLogFunction("SaveDiet");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && isset($output["ConfirmSave"]) && $output["ConfirmSave"]) {
  $confirmSave = $output["ConfirmSave"];
} else {
  $error = $errorData;
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
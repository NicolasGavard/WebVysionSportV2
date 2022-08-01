<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXNutritionTemplateDietData.php");

list($distriXNutritionTemplatetDietData, $errorJson)  = DistriXNutritionTemplateDietData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $distriXNutritionTemplatetDietData);
$servicesCaller->setServiceName("App/Nutrition/MyTemplatesDiets/Services/DistriXNutritionMyTemplatesDietsViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_MyTemplatetDiet")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXMyTemplatetDietViewDataSvc");
  $logInfoData->setLogFunction("ViewMyTemplatetDiet");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewMyTemplateDiet"])) {
    // $distriXNutritionTemplatetDietData = $output["ViewMyTemplateDiet"];
    list($distriXNutritionTemplatetDietData, $jsonError) = DistriXNutritionTemplateDietData::getJsonData($output["ViewMyTemplateDiet"]);
  }
} else {
  $error = $errorData;
}

$resp["ViewMyTemplateDiet"]  = $distriXNutritionTemplatetDietData;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
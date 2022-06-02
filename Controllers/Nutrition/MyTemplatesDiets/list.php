<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// STY APP
include(__DIR__ . "/../../../DistriXSvc/DistriXSvcUtil.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../Data/DistriXNutritionTemplateDietData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp               = [];
$error              = [];
$output             = [];
$outputok           = false;

$_POST['idUserCoach']        = 1;
$listMyTemplateDiets          = [];
$listMyCurrentDietsFormFront  = [];

list($distriXNutritionTemplateDietData, $errorJson) = DistriXNutritionTemplateDietData::getJsonData($_POST);

// All My Templates Diets
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setServiceName("Nutrition/TemplateDiet/DistriXNutritionMyTemplatesDietsListDataSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionTemplateDietData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);
if ($outputok && isset($output["ListMyTemplatesDiets"]) && is_array($output["ListMyTemplatesDiets"])) {
  list($listMyTemplateDiets, $jsonError) = DistriXNutritionTemplateDietData::getJsonArray($output["ListMyTemplatesDiets"]);
} else {
  $error = $errorData;
}

$resp["ListMyTemplatesDiets"] = $listMyTemplateDiets;
if(!empty($error)){
  $resp["Error"]              = $error;
}

echo json_encode($resp);
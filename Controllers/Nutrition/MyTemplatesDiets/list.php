<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
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

$resp               = array();
$listMyTemplateDiets= array();
$error              = array();
$output             = array();
$outputok           = false;

$distriXNutritionTemplateDietData = new DistriXNutritionTemplateDietData();
$distriXNutritionTemplateDietData->setIdUser($_POST['idUser']);
$distriXNutritionTemplateDietData->setStatus($_POST['status']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListMyTemplatesDiets");
$servicesCaller->setServiceName("DistriXServices/Nutrition/TemplateDiet/DistriXNutritionMyTemplatesDietsListDataSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionTemplateDietData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListMyTemplatesDiets"])) {
    $listMyTemplateDiets = $output["ListMyTemplatesDiets"];
  }
} else {
  $error = $errorData;
}

$resp["ListMyTemplatesDiets"] = $listMyTemplateDiets;
if(!empty($error)){
  $resp["Error"]              = $error;
}

echo json_encode($resp);
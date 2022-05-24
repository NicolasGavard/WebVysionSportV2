<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../Data/DistriXNutritionCurrentDietData.php");
include(__DIR__ . "/../../Data/DistriXNutritionCurrentDietUsersData.php");
include(__DIR__ . "/../../Data/DistriXNutritionTemplateDietData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp               = array();
$listMyCurrentDiets = array();
$listMyTemplateDiets= array();
$error              = array();
$output             = array();
$outputok           = false;

$_POST['idUser'] = 1;
$_POST['status'] = 0;

$distriXNutritionCurrentDietData = new DistriXNutritionCurrentDietData();
$distriXNutritionCurrentDietData->setIdUser($_POST['idUser']);
$distriXNutritionCurrentDietData->setStatus($_POST['status']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListMyCurrentsDiets");
$servicesCaller->setServiceName("DistriXServices/Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionCurrentDietData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListMyCurrentsDiets"])) {
    $listMyCurrentDiets = $output["ListMyCurrentsDiets"];
  }
} else {
  $error = $errorData;
}

$distriXNutritionTemplateDietData = new DistriXNutritionTemplateDietData();
$distriXNutritionTemplateDietData->setIdUser($_POST['idUser']);
$distriXNutritionTemplateDietData->setStatus(0);

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

$resp["ListMyCurrentsDiets"]  = $listMyCurrentDiets;
$resp["ListMyTemplatesDiets"] = $listMyTemplateDiets;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
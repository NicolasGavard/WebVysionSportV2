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

// Current Diet
$distriXNutritionCurrentDietData = new DistriXNutritionCurrentDietData();
$distriXNutritionCurrentDietData->setIdUser($_POST['idUser']);
$distriXNutritionCurrentDietData->setStatus($_POST['status']);

$currentDietCaller = new DistriXServicesCaller();
$currentDietCaller->setMethodName("ListMyCurrentsDiets");
$currentDietCaller->setServiceName("DistriXServices/Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$currentDietCaller->addParameter("data", $distriXNutritionCurrentDietData);

// Template Diet
$distriXNutritionTemplateDietData = new DistriXNutritionTemplateDietData();
$distriXNutritionTemplateDietData->setIdUser($_POST['idUser']);
$distriXNutritionTemplateDietData->setStatus(0);

$templateDietCaller = new DistriXServicesCaller();
$templateDietCaller->setMethodName("ListMyTemplatesDiets");
$templateDietCaller->setServiceName("DistriXServices/Nutrition/TemplateDiet/DistriXNutritionMyTemplatesDietsListDataSvc.php");
$templateDietCaller->addParameter("data", $distriXNutritionTemplateDietData);

// Add Caller to multi caller
$svc = new DistriXSvc();
$svc->addToCall("CurrentDiet", $currentDietCaller);
$svc->addToCall("TemplateDiet", $templateDietCaller);

$callsOk = $svc->call();

// Current Diet
list($outputok, $output, $errorData) = $svc->getResult("CurrentDiet"); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListMyCurrentsDiets"])) {
    $listMyCurrentDiets = $output["ListMyCurrentsDiets"];
  }
} else {
  $error = $errorData;
}

// Template Diet
list($outputok, $output, $errorData) = $svc->getResult("TemplateDiet"); //var_dump($output);
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
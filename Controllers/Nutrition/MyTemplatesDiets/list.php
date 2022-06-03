<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// STY APP
include(__DIR__ . "/../../../DistriXSvc/DistriXSvcUtil.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyTemplatesDiets/DistriXNutritionTemplateDietData.php");
include(__DIR__ . "/../../Data/Nutrition/MyCurrentsDiets/DistriXNutritionCurrentDietData.php");
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

$listMyTemplateDietsFormFront = [];
$listMyTemplateDiets          = [];
$listMyCurrentDietsFormFront  = [];

list($distriXNutritionTemplateDietData, $errorJson) = DistriXNutritionTemplateDietData::getJsonData($_POST);
list($distriXNutritionCurrentDietData, $errorJson)  = DistriXNutritionCurrentDietData::getJsonData($_POST);

// CALL
$templateDietCaller = new DistriXServicesCaller();
$templateDietCaller->setServiceName("Nutrition/TemplateDiet/DistriXNutritionMyTemplatesDietsListDataSvc.php");
$templateDietCaller->addParameter("data", $distriXNutritionTemplateDietData);

$currentDietCaller = new DistriXServicesCaller();
$currentDietCaller->setServiceName("Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$currentDietCaller->addParameter("data", $distriXNutritionCurrentDietData);

$svc = new DistriXSvc();
$svc->addToCall("templateDiet", $templateDietCaller);
$svc->addToCall("currentDiet", $currentDietCaller);
$callsOk = $svc->call();


list($outputok, $output, $errorData) = $svc->getResult("templateDiet"); //print_r($output);
if ($outputok && isset($output["ListMyTemplatesDiets"]) && is_array($output["ListMyTemplatesDiets"])) {
  list($listMyTemplateDiets, $jsonError) = DistriXNutritionTemplateDietData::getJsonArray($output["ListMyTemplatesDiets"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("currentDiet"); //print_r($output);
if ($outputok && isset($output["ListMyCurrentsDiets"]) && is_array($output["ListMyCurrentsDiets"])) {
  list($listMyCurrentDiets, $jsonError) = DistriXNutritionCurrentDietData::getJsonArray($output["ListMyCurrentsDiets"]);
} else {
  $error = $errorData;
}

foreach ($listMyTemplateDiets as $templateDiet) {
  $distriXNutritionTemplateDietData = new DistriXNutritionTemplateDietData();
  $distriXNutritionTemplateDietData->setId($templateDiet->getId());
  $distriXNutritionTemplateDietData->setIdUserCoach($templateDiet->getIdUserCoach());
  $distriXNutritionTemplateDietData->setName($templateDiet->getName());
  $distriXNutritionTemplateDietData->setDuration($templateDiet->getDuration());
  $distriXNutritionTemplateDietData->setTags($templateDiet->getTags());

  $nbStudentAssigned = 0;
  foreach ($listMyCurrentDiets as $currentDiet) {
    if ($templateDiet->getId() == $currentDiet->getIdDietTemplate()){
      $nbStudentAssigned++;
    }
  }
  $distriXNutritionTemplateDietData->setNbStudentAssigned($nbStudentAssigned);
  
  $distriXNutritionTemplateDietData->setElemState($templateDiet->getElemState());
  $distriXNutritionTemplateDietData->setTimestamp($templateDiet->getTimestamp());

  $listMyTemplateDietsFormFront[] = $distriXNutritionTemplateDietData;
}

$resp["ListMyTemplatesDiets"] = $listMyTemplateDietsFormFront;
if(!empty($error)){
  $resp["Error"]              = $error;
}

echo json_encode($resp);
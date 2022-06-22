<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../Data/DistriXNutritionTemplateDietData.php");
include(__DIR__ . "/../../MyCurrentsDiets/Data/DistriXNutritionCurrentDietData.php");

$listMyTemplateDietsFormFront = [];
$listMyCurrentDiets           = [];
$listMyTemplateDiets          = [];

list($distriXNutritionCurrentDietData, $errorJson)  = DistriXNutritionCurrentDietData::getJsonData($_POST);
list($distriXNutritionTemplateDietData, $errorJson) = DistriXNutritionTemplateDietData::getJsonData($_POST);

// CALL
$dietCurrentCaller = new DistriXServicesCaller();
$dietCurrentCaller->setServiceName("App/Nutrition/MyCurrentsDiets/Services/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$dietCurrentCaller->addParameter("data", $distriXNutritionCurrentDietData);

$dietTemplateCaller = new DistriXServicesCaller();
$dietTemplateCaller->setServiceName("App/Nutrition/MyTemplatesDiets/Services/DistriXNutritionMyTemplatesDietsListDataSvc.php");
$dietTemplateCaller->addParameter("data", $distriXNutritionTemplateDietData);

$svc = new DistriXSvc();
$svc->addToCall("dietCurrent", $dietCurrentCaller);
$svc->addToCall("dietTemplate", $dietTemplateCaller);
$callsOk = $svc->call();


list($outputok, $output, $errorData) = $svc->getResult("dietCurrent"); print_r($errorData);
if ($outputok && isset($output["ListMyCurrentsDiets"]) && is_array($output["ListMyCurrentsDiets"])) {
  list($listMyCurrentDiets, $jsonError) = DistriXNutritionCurrentDietData::getJsonArray($output["ListMyCurrentsDiets"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("dietTemplate"); //print_r($output);
if ($outputok && isset($output["ListMyTemplatesDiets"]) && is_array($output["ListMyTemplatesDiets"])) {
  list($listMyTemplateDiets, $jsonError) = DistriXNutritionTemplateDietData::getJsonArray($output["ListMyTemplatesDiets"]);
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
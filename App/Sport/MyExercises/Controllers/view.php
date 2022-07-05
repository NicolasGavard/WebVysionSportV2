<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../Data/DistriXSportMyExercisesData.php");
include(__DIR__ . "/../../../Nutrition/MyTemplatesDiets/Data/DistriXNutritionTemplateDietData.php");

if ($_POST){
  list($distriXNutritionCurrentDietData, $errorJson) = DistriXSportMyExercisesData::getJsonData($_POST);
  
  // CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setServiceName("App/Nutrition/MyCurrentsDiets/Services/DistriXNutritionMyCurrentsDietsViewDataSvc.php");
  $servicesCaller->addParameter("data", $distriXNutritionCurrentDietData);
  list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
  $logOk = logController("Security_CurrentDiet", "DistriXMyCurrentDietViewDataSvc", "ViewMyCurrentDiet", $output);
  
  if ($outputok && isset($output["ViewMyCurrentDiet"])) {
    list($distriXNutritionCurrentDietData, $jsonError) = DistriXSportMyExercisesData::getJsonData($output["ViewMyCurrentDiet"]);
    
    $distriXNutritionTemplateDietData = new DistriXNutritionTemplateDietData();
    $distriXNutritionTemplateDietData->setId($distriXNutritionCurrentDietData->getIdDietTemplate());
    
    $servicesCaller = new DistriXServicesCaller();
    $servicesCaller->setServiceName("App/Nutrition/MyTemplatesDiets/Services/DistriXNutritionMyTemplatesDietsViewDataSvc.php");
    $servicesCaller->addParameter("data", $distriXNutritionTemplateDietData);
    list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
    $logOk = logController("Security_CurrentDiet", "DistriXNutritionMyTemplatesDietsViewDataSvc", "ViewMyTemplateDiet", $output);
    if ($outputok && isset($output["ViewMyTemplateDiet"])) {
      list($templateDiet, $jsonError) = DistriXNutritionTemplateDietData::getJsonData($output["ViewMyTemplateDiet"]);
    }

    $infoUser = DistriXStyAppUser::viewUser($distriXNutritionCurrentDietData->getIdUserStudent());
    
    $distriXNutritionCurrentDietData->setId($distriXNutritionCurrentDietData->getId());
    $distriXNutritionCurrentDietData->setIdUserStudent($distriXNutritionCurrentDietData->getIdUserStudent());
    $distriXNutritionCurrentDietData->setNameUserStudent($infoUser->getName());
    $distriXNutritionCurrentDietData->setFirstNameUserStudent($infoUser->getFirstName());
    $distriXNutritionCurrentDietData->setIdDietTemplate($distriXNutritionCurrentDietData->getIdDietTemplate());
    $distriXNutritionCurrentDietData->setName($templateDiet->getName());
  } else {
    $error = $errorData;
  }

  $resp["ViewMyCurrentDiet"]  = $distriXNutritionCurrentDietData;
  if(!empty($error)){
    $resp["Error"]    = $error;
  }
}


echo json_encode($resp);
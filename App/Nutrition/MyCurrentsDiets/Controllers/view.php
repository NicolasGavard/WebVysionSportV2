<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyCurrentsDiets/DistriXNutritionCurrentDietData.php");
include(__DIR__ . "/../../Data/Nutrition/MyTemplatesDiets/DistriXNutritionTemplateDietData.php");

$_POST['id'] = 1;

if ($_POST){
  list($distriXNutritionCurrentDietData, $errorJson) = DistriXNutritionCurrentDietData::getJsonData($_POST);
  
  // CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setServiceName("Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsViewDataSvc.php");
  $servicesCaller->addParameter("data", $distriXNutritionCurrentDietData);
  list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
  $logOk = logController("Security_CurrentDiet", "DistriXMyCurrentDietViewDataSvc", "ViewMyCurrentDiet", $output);
  
  if ($outputok && isset($output["ViewMyCurrentDiet"])) {
    list($distriXNutritionCurrentDietData, $jsonError) = DistriXNutritionCurrentDietData::getJsonData($output["ViewMyCurrentDiet"]);
    
    $distriXNutritionTemplateDietData = new DistriXNutritionTemplateDietData();
    $distriXNutritionTemplateDietData->setId($distriXNutritionCurrentDietData->getIdDietTemplate());
    
    $servicesCaller = new DistriXServicesCaller();
    $servicesCaller->setServiceName("Nutrition/TemplateDiet/DistriXNutritionMyTemplatesDietsViewDataSvc.php");
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
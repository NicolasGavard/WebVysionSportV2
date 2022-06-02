<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSvc/DistriXSvcUtil.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../Data/Nutrition/MyCurrentsDiets/DistriXNutritionCurrentDietData.php");
include(__DIR__ . "/../../Data/Nutrition/MyTemplatesDiets/DistriXNutritionTemplateDietData.php");
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
$listMyCurrentDiets           = [];
$listMyTemplateDiets          = [];
$listMyCurrentDietsFormFront  = [];

// List Users
$ListUsers                    = DistriXStyAppUser::listUsers();

// Current Diet
list($distriXNutritionCurrentDietData, $errorJson)  = DistriXNutritionCurrentDietData::getJsonData($_POST);
list($distriXNutritionTemplateDietData, $errorJson) = DistriXNutritionTemplateDietData::getJsonData($_POST);

// All My Current Diets
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setServiceName("Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionCurrentDietData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);
if ($outputok && isset($output["ListMyCurrentsDiets"]) && is_array($output["ListMyCurrentsDiets"])) {
  list($listMyCurrentDiets, $jsonError) = DistriXNutritionCurrentDietData::getJsonArray($output["ListMyCurrentsDiets"]);
} else {
  $error = $errorData;
}

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

foreach ($listMyCurrentDiets as $currentDiet) {
  $distriXNutritionCurrentDietData = new DistriXNutritionCurrentDietData();
  $distriXNutritionCurrentDietData->setId($currentDiet->getId());
  $distriXNutritionCurrentDietData->setIdUserCoach($currentDiet->getIdUserCoach());
  
  foreach ($ListUsers as $user) {
    if ($currentDiet->getIdUserCoach() == $user->getId()){
      $distriXNutritionCurrentDietData->setNameUserCoach($user->getName());
      $distriXNutritionCurrentDietData->setFirstNameUserCoach($user->getFirstName());
    }
    if ($currentDiet->getIdUserStudent() == $user->getId()){
      $distriXNutritionCurrentDietData->setNameUserStudent($user->getName());
      $distriXNutritionCurrentDietData->setFirstNameUserStudent($user->getFirstName());
    }
  }

  $distriXNutritionCurrentDietData->setIdDietTemplate($currentDiet->getIdDietTemplate());
  
  $duration = 0;
  foreach ($listMyTemplateDiets as $templateDiet) {
    if ($currentDiet->getIdDietTemplate() == $templateDiet->getId()) {
      $distriXNutritionCurrentDietData->setName($templateDiet->getName());
      $distriXNutritionCurrentDietData->setDuration($templateDiet->getDuration());
      $distriXNutritionCurrentDietData->setTags($templateDiet->getTags());
      $duration = $templateDiet->getDuration();
    }
  }
  $distriXNutritionCurrentDietData->setDateStart($currentDiet->getDateStart());

  $date_start         = DistriXSvcUtil::getjmaDate($currentDiet->getDateStart());
  $date_start         = $date_start[0].'-'.$date_start[1].'-'.$date_start[2];
  $date_rest          = new DateTime('now'); 
  // Trouver la date de fin
  $date_end           =  date('Y-m-d', strtotime($date_start. ' + '.$duration.' days'));
  $date_fin           = new DateTime($date_end);
  // Nombre de jours restant
  $interval           = $date_rest->diff($date_fin);
  $nbDaysInterval     = $interval->format('%d');

  // Faire pourcentage
  $advancement_rest   = 100;
  $advancement_done   = 100;
  if (str_replace("-", "", $date_end) > date('Ymd')){
    if ($duration > 0) {
      $advancement_rest = round(($nbDaysInterval / $duration) * 100, 2);
    }
    $advancement_done   = 100 - round($advancement_rest,2);
  }
  $distriXNutritionCurrentDietData->setAdvancement($advancement_done);
  $distriXNutritionCurrentDietData->setElemState($currentDiet->getElemState());
  $distriXNutritionCurrentDietData->setTimestamp($currentDiet->getTimestamp());
  $listMyCurrentDietsFormFront[] = $distriXNutritionCurrentDietData;
}

$resp["ListMyCurrentsDiets"]  = $listMyCurrentDietsFormFront;
$resp["ListMyTemplatesDiets"] = $listMyTemplateDiets;
$resp["ListMyStudents"]       = $ListUsers;
if(!empty($error)){
  $resp["Error"]              = $error;
}

echo json_encode($resp);
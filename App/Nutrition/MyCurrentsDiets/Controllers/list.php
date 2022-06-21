<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity//Data/DistriXStyUserData.php");
include(__DIR__ . "/../Data/DistriXNutritionCurrentDietData.php");
include(__DIR__ . "/../../MyTemplatesDiets/Data/DistriXNutritionTemplateDietData.php");

$listMyCurrentDiets           = [];
$listMyTemplateDiets          = [];
$listUsers                    = [];
$listMyCurrentDietsFormFront  = [];

$_POST['idUserCoach']         = 1;
if (!empty($_POST) && isset($_POST)) {
  // List Users
  // $listUsers                  = DistriXStyAppUser::listUsers();
  $listUsers                  = [];

  // Current Diet
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

  list($outputok, $output, $errorData) = $svc->getResult("dietCurrent"); //print_r($errorData);
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

  foreach ($listMyCurrentDiets as $currentDiet) {
    $distriXNutritionCurrentDietData = new DistriXNutritionCurrentDietData();
    $distriXNutritionCurrentDietData->setId($currentDiet->getId());
    $distriXNutritionCurrentDietData->setIdUserCoach($currentDiet->getIdUserCoach());
    
    foreach ($listUsers as $user) {
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
}

$resp["ListMyCurrentsDiets"]  = $listMyCurrentDietsFormFront;
$resp["ListMyTemplatesDiets"] = $listMyTemplateDiets;
$resp["ListMyStudents"]       = $listUsers;
if(!empty($error)){
  $resp["Error"]              = $error;
}

echo json_encode($resp);
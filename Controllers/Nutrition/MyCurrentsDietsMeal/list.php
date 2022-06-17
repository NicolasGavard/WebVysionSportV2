<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyCurrentsDietsMeal/DistriXNutritionCurrentDietMealData.php");
include(__DIR__ . "/../../Data/CodeTables/MealType/DistriXCodeTableMealTypeData.php");

$listMyCurrentDietMeals           = [];
$listMyTemplateDiets              = [];
$listMyCurrentDietMealsFormFront  = [];

$_POST['idDiet'] = 1;
list($distriXNutritionCurrentDietMealMealData, $errorJson)  = DistriXNutritionCurrentDietMealData::getJsonData($_POST);

$infoProfil   = DistriXStyAppInterface::getUserInformation();

// List DietMeal with idDiet
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setServiceName("Nutrition/CurrentDietMeal/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionCurrentDietMealMealData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);
if ($outputok && isset($output["ListMyCurrentsDiets"]) && is_array($output["ListMyCurrentsDiets"])) {
  list($listMyCurrentDietMeals, $jsonError) = DistriXNutritionCurrentDietMealData::getJsonArray($output["ListMyCurrentsDiets"]);
} else {
  $error = $errorData;
}

$recipeCaller = new DistriXServicesCaller();
$recipeCaller->setMethodName("ViewMyRecipe");
$recipeCaller->addParameter("data", $recipe);
$recipeCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesViewDataSvc.php");
list($outputok, $output, $errorData) = $recipeCaller->call(); //var_dump($output);


$dataName       = new DistriXCodeTableMealTypeNameData();
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("dataName", $dataName);
$servicesCaller->setServiceName("TablesCodes/MealType/DistriXMealTypeListDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("Language", $languageCaller);
$svc->addToCall("MealType", $servicesCaller);
$callsOk = $svc->call();



// Current Diet
list($distriXNutritionCurrentDietMealData, $errorJson)  = DistriXNutritionCurrentDietMealData::getJsonData($_POST);
list($distriXNutritionTemplateDietData, $errorJson) = DistriXNutritionTemplateDietData::getJsonData($_POST);

// All My Current Diets
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setServiceName("Nutrition/CurrentDietMeal/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionCurrentDietMealData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);
if ($outputok && isset($output["ListMyCurrentsDiets"]) && is_array($output["ListMyCurrentsDiets"])) {
  list($listMyCurrentDietMeals, $jsonError) = DistriXNutritionCurrentDietMealData::getJsonArray($output["ListMyCurrentsDiets"]);
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

foreach ($listMyCurrentDietMeals as $currentDiet) {
  $distriXNutritionCurrentDietMealData = new DistriXNutritionCurrentDietMealData();
  $distriXNutritionCurrentDietMealData->setId($currentDiet->getId());
  $distriXNutritionCurrentDietMealData->setIdUserCoach($currentDiet->getIdUserCoach());
  
  foreach ($ListUsers as $user) {
    if ($currentDiet->getIdUserCoach() == $user->getId()){
      $distriXNutritionCurrentDietMealData->setNameUserCoach($user->getName());
      $distriXNutritionCurrentDietMealData->setFirstNameUserCoach($user->getFirstName());
    }
    if ($currentDiet->getIdUserStudent() == $user->getId()){
      $distriXNutritionCurrentDietMealData->setNameUserStudent($user->getName());
      $distriXNutritionCurrentDietMealData->setFirstNameUserStudent($user->getFirstName());
    }
  }

  $distriXNutritionCurrentDietMealData->setIdDietTemplate($currentDiet->getIdDietTemplate());
  
  $duration = 0;
  foreach ($listMyTemplateDiets as $templateDiet) {
    if ($currentDiet->getIdDietTemplate() == $templateDiet->getId()) {
      $distriXNutritionCurrentDietMealData->setName($templateDiet->getName());
      $distriXNutritionCurrentDietMealData->setDuration($templateDiet->getDuration());
      $distriXNutritionCurrentDietMealData->setTags($templateDiet->getTags());
      $duration = $templateDiet->getDuration();
    }
  }

  $distriXNutritionCurrentDietMealData->setDateStart($currentDiet->getDateStart());
  
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
  $distriXNutritionCurrentDietMealData->setAdvancement($advancement_done);
  $distriXNutritionCurrentDietMealData->setElemState($currentDiet->getElemState());
  $distriXNutritionCurrentDietMealData->setTimestamp($currentDiet->getTimestamp());
  $listMyCurrentDietMealsFormFront[] = $distriXNutritionCurrentDietMealData;
}

$resp["ListMyCurrentsDiets"]  = $listMyCurrentDietMealsFormFront;
$resp["ListMyTemplatesDiets"] = $listMyTemplateDiets;
$resp["ListMyStudents"]       = $ListUsers;
if(!empty($error)){
  $resp["Error"]              = $error;
}

echo json_encode($resp);
<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyCurrentsDietsMeal/DistriXNutritionCurrentDietMealData.php");
include(__DIR__ . "/../../Data/Nutrition/MyCurrentsDiets/DistriXNutritionCurrentDietData.php");
include(__DIR__ . "/../../Data/Nutrition/MyRecipes/DistriXNutritionRecipeData.php");
include(__DIR__ . "/../../Data/Nutrition/MyTemplatesDiets/DistriXNutritionTemplateDietData.php");
include(__DIR__ . "/../../Data/CodeTables/MealType/DistriXCodeTableMealTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/MealType/DistriXCodeTableMealTypeNameData.php");

$listMyCurrentDietMealsFormFront   = [];

$_POST['idDiet']          = 1;
list($distriXNutritionCurrentDietMealMealData, $errorJson)  = DistriXNutritionCurrentDietMealData::getJsonData($_POST);

$infoProfil                       = DistriXStyAppInterface::getUserInformation();
$distriXNutritionCurrentDietData  = new DistriXNutritionCurrentDietData();
$distriXNutritionCurrentDietData->setIdUserCoach($infoProfil->getId());

$distriXNutritionRecipeData       = new DistriXNutritionRecipeData();
$distriXNutritionRecipeData->setIdUserCoach($infoProfil->getId());

// List DietMeal with idDiet
$dietMealCaller = new DistriXServicesCaller();
$dietMealCaller->setServiceName("Nutrition/CurrentDietMeal/DistriXNutritionMyCurrentsDietMealsFindDataSvc.php");
$dietMealCaller->addParameter("data", $distriXNutritionCurrentDietMealMealData);

$dietCurrentCaller = new DistriXServicesCaller();
$dietCurrentCaller->setServiceName("Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$dietCurrentCaller->addParameter("data", $distriXNutritionCurrentDietData);

$recipeCaller = new DistriXServicesCaller();
$recipeCaller->setServiceName("Nutrition/TemplateDiet/DistriXNutritionMyTemplatesDietsListDataSvc.php");
$recipeCaller->addParameter("data", $distriXNutritionRecipeData);


$dietRecipeCaller = new DistriXServicesCaller();
$dietRecipeCaller->setServiceName("Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListDataSvc.php");

$dataName       = new DistriXCodeTableMealTypeNameData();
$mealTypeCaller = new DistriXServicesCaller();
$mealTypeCaller->addParameter("dataName", $dataName);
$mealTypeCaller->setServiceName("TablesCodes/MealType/DistriXMealTypeListDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("dietMeal", $dietMealCaller);
$svc->addToCall("dietCurrent", $dietCurrentCaller);
$svc->addToCall("recipe", $recipeCaller);
$svc->addToCall("mealType", $mealTypeCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("dietMeal"); //print_r($output);
if ($outputok && isset($output["ListDietMeals"]) && is_array($output["ListDietMeals"])) {
  list($listMyCurrentDietMeals, $jsonError) = DistriXNutritionCurrentDietMealData::getJsonArray($output["ListDietMeals"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("dietCurrent"); //print_r($output);
if ($outputok && isset($output["ListMyCurrentsDiets"]) && is_array($output["ListMyCurrentsDiets"])) {
  list($listMyCurrentDiet, $jsonError) = DistriXNutritionCurrentDietData::getJsonArray($output["ListMyCurrentsDiets"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("recipe"); //print_r($output);
if ($outputok && isset($output["ListMyRecipes"]) && is_array($output["ListMyRecipes"])) {
  list($listMyRecipe, $jsonError) = DistriXNutritionRecipeData::getJsonArray($output["ListMyRecipes"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("mealType"); //print_r($output);
if ($outputok && isset($output["ListMealTypes"]) && is_array($output["ListMealTypes"])) {
  list($listMealTypes, $jsonError) = DistriXCodeTableMealTypeData::getJsonArray($output["ListMealTypes"]);
} else {
  $error = $errorData;
}

echo '</br></br>';
print_r($listMyCurrentDietMeals);
echo '</br></br>';

foreach ($listMyCurrentDietMeals as $currentDietMeal) {
  $foods = [];

  $distriXNutritionCurrentDietMealData = new DistriXNutritionCurrentDietMealData();
  $distriXNutritionCurrentDietMealData->setId($currentDietMeal->getId());
  $distriXNutritionCurrentDietMealData->setIdDiet($currentDietMeal->getIdDiet());
  $distriXNutritionCurrentDietMealData->setIdDietRecipe($currentDietMeal->getIdDietRecipe());

  foreach ($listMyRecipe as $recipe) {
    if ($recipe->getId() == $currentDietMeal->getIdDietRecipe()){
      $distriXNutritionCurrentDietMealData->setNameDietRecipe('');
    }
  }

  $distriXNutritionCurrentDietMealData->setDayNumber($currentDietMeal->getDayNumber());
  $distriXNutritionCurrentDietMealData->setIdMealType($currentDietMeal->getIdMealType());
  $distriXNutritionCurrentDietMealData->setNameMealType('');
  $distriXNutritionCurrentDietMealData->setFoods($foods);
  $listMyCurrentDietMealsFormFront[] = $distriXNutritionCurrentDietMealData;
}

// foreach ($listMyCurrentDietMeals as $currentDiet) {
//   $distriXNutritionCurrentDietMealData = new DistriXNutritionCurrentDietMealData();
//   $distriXNutritionCurrentDietMealData->setId($currentDiet->getId());
//   $distriXNutritionCurrentDietMealData->setIdUserCoach($currentDiet->getIdUserCoach());
  
//   foreach ($ListUsers as $user) {
//     if ($currentDiet->getIdUserCoach() == $user->getId()){
//       $distriXNutritionCurrentDietMealData->setNameUserCoach($user->getName());
//       $distriXNutritionCurrentDietMealData->setFirstNameUserCoach($user->getFirstName());
//     }
//     if ($currentDiet->getIdUserStudent() == $user->getId()){
//       $distriXNutritionCurrentDietMealData->setNameUserStudent($user->getName());
//       $distriXNutritionCurrentDietMealData->setFirstNameUserStudent($user->getFirstName());
//     }
//   }

//   $distriXNutritionCurrentDietMealData->setIdDietTemplate($currentDiet->getIdDietTemplate());
  
//   $duration = 0;
//   foreach ($listMyTemplateDiets as $templateDiet) {
//     if ($currentDiet->getIdDietTemplate() == $templateDiet->getId()) {
//       $distriXNutritionCurrentDietMealData->setName($templateDiet->getName());
//       $distriXNutritionCurrentDietMealData->setDuration($templateDiet->getDuration());
//       $distriXNutritionCurrentDietMealData->setTags($templateDiet->getTags());
//       $duration = $templateDiet->getDuration();
//     }
//   }

//   $distriXNutritionCurrentDietMealData->setDateStart($currentDiet->getDateStart());
  
//   $date_start         = DistriXSvcUtil::getjmaDate($currentDiet->getDateStart());
//   $date_start         = $date_start[0].'-'.$date_start[1].'-'.$date_start[2];
//   $date_rest          = new DateTime('now'); 
//   // Trouver la date de fin
//   $date_end           =  date('Y-m-d', strtotime($date_start. ' + '.$duration.' days'));
//   $date_fin           = new DateTime($date_end);
//   // Nombre de jours restant
//   $interval           = $date_rest->diff($date_fin);
//   $nbDaysInterval     = $interval->format('%d');

//   // Faire pourcentage
//   $advancement_rest   = 100;
//   $advancement_done   = 100;
//   if (str_replace("-", "", $date_end) > date('Ymd')){
//     if ($duration > 0) {
//       $advancement_rest = round(($nbDaysInterval / $duration) * 100, 2);
//     }
//     $advancement_done   = 100 - round($advancement_rest,2);
//   }
//   $distriXNutritionCurrentDietMealData->setAdvancement($advancement_done);
//   $distriXNutritionCurrentDietMealData->setElemState($currentDiet->getElemState());
//   $distriXNutritionCurrentDietMealData->setTimestamp($currentDiet->getTimestamp());
//   $listMyCurrentDietMealsFormFront[] = $distriXNutritionCurrentDietMealData;
// }

$resp["ListMyCurrentsDietMeals"]  = $listMyCurrentDietMealsFormFront;
if(!empty($error)){
  $resp["Error"]                  = $error;
}

echo json_encode($resp);
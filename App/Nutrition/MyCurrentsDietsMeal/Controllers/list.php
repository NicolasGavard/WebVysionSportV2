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

// PREPARE CALL
$dietMealCaller = new DistriXServicesCaller();
$dietMealCaller->setServiceName("Nutrition/CurrentDietMeal/DistriXNutritionMyCurrentsDietMealsFindDataSvc.php");
$dietMealCaller->addParameter("data", $distriXNutritionCurrentDietMealMealData);

$dietCurrentCaller = new DistriXServicesCaller();
$dietCurrentCaller->setServiceName("Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$dietCurrentCaller->addParameter("data", $distriXNutritionCurrentDietData);

$recipeCaller = new DistriXServicesCaller();
$recipeCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesListDataSvc.php");
$recipeCaller->addParameter("data", $distriXNutritionRecipeData);

$dietRecipeCaller = new DistriXServicesCaller();
$dietRecipeCaller->setServiceName("Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListDataSvc.php");

$dataName       = new DistriXCodeTableMealTypeNameData();
$mealTypeCaller = new DistriXServicesCaller();
$mealTypeCaller->addParameter("dataName", $dataName);
$mealTypeCaller->setServiceName("TablesCodes/MealType/DistriXMealTypeListDataSvc.php");

// CALL
$svc = new DistriXSvc();
$svc->addToCall("dietMeal", $dietMealCaller);
$svc->addToCall("dietCurrent", $dietCurrentCaller);
$svc->addToCall("recipe", $recipeCaller);
$svc->addToCall("mealType", $mealTypeCaller);
$callsOk = $svc->call();

// RESPONSES
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
  list($listMealTypes, $jsonError)      = DistriXCodeTableMealTypeData::getJsonArray($output["ListMealTypes"]);
  list($listMealTypeNames, $jsonError)  = DistriXCodeTableMealTypeNameData::getJsonArray($output["ListMealTypeNames"]);
} else {
  $error = $errorData;
}

// TREATMENT
foreach ($listMyCurrentDietMeals as $currentDietMeal) {
  $foods = [];

  $distriXNutritionCurrentDietMealData = new DistriXNutritionCurrentDietMealData();
  $distriXNutritionCurrentDietMealData->setId($currentDietMeal->getId());
  $distriXNutritionCurrentDietMealData->setIdDiet($currentDietMeal->getIdDiet());
  $distriXNutritionCurrentDietMealData->setIdDietRecipe($currentDietMeal->getIdDietRecipe());

  foreach ($listMyRecipe as $recipe) {
    if ($recipe->getId() == $currentDietMeal->getIdDietRecipe()){
      $distriXNutritionCurrentDietMealData->setNameDietRecipe($recipe->getName());
      break;
    }
  }
  
  $distriXNutritionCurrentDietMealData->setDayNumber($currentDietMeal->getDayNumber());
  $distriXNutritionCurrentDietMealData->setIdMealType($currentDietMeal->getIdMealType());
  foreach ($listMealTypeNames as $mealTypeName) {
    if ($mealTypeName->getIdMealType() == $currentDietMeal->getIdMealType()){
      $distriXNutritionCurrentDietMealData->setNameMealType($mealTypeName->getName());
    }
  }
  $distriXNutritionCurrentDietMealData->setFoods($foods);
  $listMyCurrentDietMealsFormFront[] = $distriXNutritionCurrentDietMealData;
}

$resp["ListMyCurrentsDietMeals"]  = $listMyCurrentDietMealsFormFront;
if(!empty($error)){
  $resp["Error"]                  = $error;
}

echo json_encode($resp);
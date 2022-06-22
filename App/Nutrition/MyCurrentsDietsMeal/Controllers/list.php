<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../Data/DistriXNutritionCurrentDietMealData.php");

include(__DIR__ . "/../../../Food/Food/Data/DistriXFoodFoodData.php");
include(__DIR__ . "/../../../Food/FoodNutritional/Data/DistriXFoodFoodNutritionalData.php");
include(__DIR__ . "/../../../Nutrition/MyCurrentsDiets/Data/DistriXNutritionCurrentDietData.php");
include(__DIR__ . "/../../../Nutrition/MyRecipes/Data/DistriXNutritionRecipeData.php");
include(__DIR__ . "/../../../Nutrition/MyRecipeFood/Data/DistriXNutritionRecipeFoodData.php");
include(__DIR__ . "/../../../Nutrition/MyTemplatesDiets/Data/DistriXNutritionTemplateDietData.php");
include(__DIR__ . "/../../../CodeTables/Language/Data/DistriXCodeTableLanguageData.php");
include(__DIR__ . "/../../../CodeTables/MealType/Data/DistriXCodeTableMealTypeData.php");
include(__DIR__ . "/../../../CodeTables/MealType/Data/DistriXCodeTableMealTypeNameData.php");

$listMyCurrentDietMealsFormFront  = [];
$listMyCurrentDietMeals           = [];
$listMyCurrentDiet                = [];
$listMyRecipe                     = [];
$listMyRecipeFood                 = [];
$listFood                         = [];
$listFoodNutritional              = [];
$listMealTypes                    = [];
$listMealTypeNames                = [];

$_POST['idDiet'] = 1;

list($distriXNutritionCurrentDietMealMealData, $errorJson)  = DistriXNutritionCurrentDietMealData::getJsonData($_POST);

$infoProfil                       = DistriXStyAppInterface::getUserInformation();
$distriXNutritionCurrentDietData  = new DistriXNutritionCurrentDietData();
$distriXNutritionCurrentDietData->setIdUserCoach($infoProfil->getId());

$distriXNutritionRecipeData       = new DistriXNutritionRecipeData();
$distriXNutritionRecipeData->setIdUserCoach($infoProfil->getId());

$distriXCodeTableLanguageData = new DistriXCodeTableLanguageData();
$distriXCodeTableLanguageData->setId($infoProfil->getIdLanguage());

// PREPARE CALL
$dietMealCaller = new DistriXServicesCaller();
$dietMealCaller->setServiceName("App/Nutrition/MyCurrentsDietsMeal/Services/DistriXNutritionMyCurrentsDietMealsFindDataSvc.php");
$dietMealCaller->addParameter("data", $distriXNutritionCurrentDietMealMealData);

$dietCurrentCaller = new DistriXServicesCaller();
$dietCurrentCaller->setServiceName("App/Nutrition/MyCurrentsDiets/Services/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$dietCurrentCaller->addParameter("data", $distriXNutritionCurrentDietData);

$recipeCaller = new DistriXServicesCaller();
$recipeCaller->setServiceName("App/Nutrition/MyRecipes/Services/DistriXNutritionMyRecipesListDataSvc.php");
$recipeCaller->addParameter("data", $distriXNutritionRecipeData);

$recipeFoodCaller = new DistriXServicesCaller();
$recipeFoodCaller->setServiceName("App/Nutrition/MyRecipeFood/Services/DistriXNutritionMyRecipeFoodsListDataSvc.php");
$recipeFoodCaller->addParameter("data", $distriXNutritionRecipeData);

$foodCaller = new DistriXServicesCaller();
$foodCaller->setServiceName("App/Food/Food/Services/DistriXFoodListDataSvc.php");
$foodCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);

$foodNutritionalCaller = new DistriXServicesCaller();
$foodNutritionalCaller->setServiceName("App/Food/FoodNutritional/Services/DistriXFoodNutritionalListDataSvc.php");

$dataName       = new DistriXCodeTableMealTypeNameData();
$mealTypeCaller = new DistriXServicesCaller();
$mealTypeCaller->addParameter("dataName", $dataName);
$mealTypeCaller->setServiceName("App/CodeTables/MealType/Services/DistriXMealTypeListDataSvc.php");

// CALL
$svc = new DistriXSvc();
$svc->addToCall("dietMeal", $dietMealCaller);
$svc->addToCall("dietCurrent", $dietCurrentCaller);
$svc->addToCall("recipe", $recipeCaller);
$svc->addToCall("recipeFood", $recipeFoodCaller);
$svc->addToCall("food", $foodCaller);
$svc->addToCall("foodNutritional", $foodNutritionalCaller);
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

list($outputok, $output, $errorData) = $svc->getResult("recipeFood"); //print_r($output);
if ($outputok && isset($output["ListMyRecipeFoods"]) && is_array($output["ListMyRecipeFoods"])) {
  list($listMyRecipeFood, $jsonError) = DistriXNutritionRecipeFoodData::getJsonArray($output["ListMyRecipeFoods"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("food"); //print_r($output);
if ($outputok && isset($output["ListFoods"]) && is_array($output["ListFoods"])) {
  list($listFood, $jsonError) = DistriXFoodFoodData::getJsonArray($output["ListFoods"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("foodNutritional"); //print_r($output);
if ($outputok && isset($output["ListFoodNutritionals"]) && is_array($output["ListFoodNutritionals"])) {
  list($listFoodNutritional, $jsonError) = DistriXFoodFoodNutritionalData::getJsonArray($output["ListFoodNutritionals"]);
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

print_r($listMyRecipe);
echo '<br><br>';
print_r($listMyRecipeFood);
echo '<br><br>';
print_r($listFood);
echo '<br><br>';
print_r($listFoodNutritional);

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
      
      foreach ($listMyRecipeFood as $recipeFood) {
        if ($recipe->getId() == $recipeFood->getIdRecipe()) {
          foreach ($listFood as $food) {
            if ($food->getId() == $recipeFood->getIdRecipe()) {
              $distriXFoodFoodData = new DistriXFoodFoodData();
              $distriXFoodFoodData->setName($recipeFood->getName());
              foreach ($listFoodNutritional as $foodNutritional) {
                if ($food->getId() == $foodNutritional->getIdFood()) {
                  $distriXFoodFoodNutritionalData = new DistriXFoodFoodNutritionalData();
                  $distriXFoodFoodNutritionalData->setId($id);
                  $distriXFoodFoodNutritionalData->setIdFood($idFood);
                  $distriXFoodFoodNutritionalData->setIdNutritional($idNutritional);
                  $foodFoodNutritionalList[] = $distriXFoodFoodNutritionalData;
                  break;
                }
              }
              $distriXFoodFoodData->setFoodNutritionals($foodFoodNutritionalList);
              break;
            }
          }
          break;
        }
      }
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
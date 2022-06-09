<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyRecipes/DistriXNutritionRecipeData.php");
include(__DIR__ . "/../../Data/Nutrition/MyRecipes/DistriXNutritionRecipeFoodData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodFoodData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodNutritionalData.php");
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");
include(__DIR__ . "/../../Data/CodeTables/WeightType/DistriXCodeTableWeightTypeData.php");

$listMyRecipesFormFront = [];
$listMyRecipes          = [];
$listMyRecipesFoods     = [];
$listFoods              = [];
$listWeightsTypes       = [];

list($distriXNutritionRecipeData, $errorJson)     = DistriXNutritionRecipeData::getJsonData($_POST);

$infoProfil = DistriXStyAppInterface::getUserInformation();
$distriXNutritionRecipeData->setIdUserCoach($infoProfil->getId());

$distriXCodeTableLanguageData = new DistriXCodeTableLanguageData();
$distriXCodeTableLanguageData->setId($infoProfil->getIdLanguage());

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesListDataSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionRecipeData);

// CALL
$receipeCaller = new DistriXServicesCaller();
$receipeCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesListDataSvc.php");
$receipeCaller->addParameter("data", $distriXNutritionRecipeData);

$recipeFoodCaller = new DistriXServicesCaller();
$recipeFoodCaller->setServiceName("Nutrition/RecipeFood/DistriXNutritionMyRecipesFoodsListDataSvc.php");

$foodCaller = new DistriXServicesCaller();
$foodCaller->setServiceName("Food/Food/DistriXFoodListDataSvc.php");
$servicesCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);

$foodNutritionalCaller = new DistriXServicesCaller();
$foodNutritionalCaller->setServiceName("Food/FoodNutritional/DistriXFoodNutritionalListDataSvc.php");

$weightTypeCaller = new DistriXServicesCaller();
$weightTypeCaller->setServiceName("TablesCodes/WeightType/DistriXWeightTypeListDataSvc.php");
$servicesCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);

$nutritionalCaller = new DistriXServicesCaller();
$nutritionalCaller->setServiceName("TablesCodes/WeightType/DistriXWeightTypeListDataSvc.php");
$servicesCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);

$svc = new DistriXSvc();
$svc->addToCall("receipe", $receipeCaller);
$svc->addToCall("recipeFood", $recipeFoodCaller);
$svc->addToCall("food", $foodCaller);
$svc->addToCall("foodNutritional", $foodNutritionalCaller);
$svc->addToCall("weightType", $weightTypeCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("receipe"); //print_r($output);
if ($outputok && isset($output["ListMyRecipes"]) && is_array($output["ListMyRecipes"])) {
  list($listMyRecipes, $jsonError) = DistriXNutritionRecipeData::getJsonArray($output["ListMyRecipes"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("recipeFood"); //print_r($output);
if ($outputok && isset($output["ListMyRecipesFoods"]) && is_array($output["ListMyRecipesFoods"])) {
  list($listMyRecipesFoods, $jsonError) = DistriXNutritionRecipeFoodData::getJsonArray($output["ListMyRecipesFoods"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("food"); //print_r($output);
if ($outputok && isset($output["ListFoods"]) && is_array($output["ListFoods"])) {
  list($listFoods, $jsonError) = DistriXFoodFoodData::getJsonArray($output["ListFoods"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("foodNutritional"); print_r($output);
if ($outputok && isset($output["ListFoodNutritionals"]) && is_array($output["ListFoodNutritionals"])) {
  list($listFoodNutritionals, $jsonError) = DistriXFoodNutritionalData::getJsonArray($output["ListFoodNutritionals"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("weightType"); //print_r($output);
if ($outputok && isset($output["ListWeightTypes"]) && is_array($output["ListWeightTypes"])) {
  list($listWeightsTypes, $jsonError) = DistriXCodeTableWeightTypeData::getJsonArray($output["ListWeightTypes"]);
} else {
  $error = $errorData;
}

foreach ($listMyRecipes as $recipe) {
  $distriXNutritionMyRecipeData = new DistriXNutritionRecipeData();
  $distriXNutritionMyRecipeData->setId($recipe->getId());
  $distriXNutritionMyRecipeData->setIdUserCoach($recipe->getIdUserCoach());
  $distriXNutritionMyRecipeData->setCode($recipe->getCode());
  $distriXNutritionMyRecipeData->setName($recipe->getName());
  $distriXNutritionMyRecipeData->setDescription($recipe->getDescription());
  $distriXNutritionMyRecipeData->setLinkToPicture($recipe->getLinkToPicture());
  $distriXNutritionMyRecipeData->setSize($recipe->getSize());
  $distriXNutritionMyRecipeData->setType($recipe->getType());
  $distriXNutritionMyRecipeData->setRating($recipe->getRating());
  $distriXNutritionMyRecipeData->setElemState($recipe->getElemState());
  $distriXNutritionMyRecipeData->setTimestamp($recipe->getTimestamp());

  $calorieTotal  = 0;
  $proetinTotal  = 0;
  $glucideTotal  = 0;
  $lipidTotal    = 0;

  $nutritionalInfo = [];
  foreach ($listMyRecipesFoods as $recipeFood) {
    if($recipe->getId() == $recipeFood->getIdRecipe()){
      $distriXNutritionMyRecipeFoodData = new DistriXNutritionRecipeFoodData();
      $distriXNutritionMyRecipeFoodData->setId($recipeFood->getId());
      $distriXNutritionMyRecipeFoodData->setIdRecipe($recipeFood->getIdRecipe());
      $distriXNutritionMyRecipeFoodData->setNameRecipe($recipeFood->getNameRecipe());
      $distriXNutritionMyRecipeFoodData->setIdFood($recipeFood->getIdFood());
      
      foreach ($listFoods as $food) {
        if($recipeFood->getIdFood() == $food->getId()){
          


          foreach ($listFoodNutritionals as $foodNutritinal) {
            if ($food->getId() == $foodNutritinal->getIdFood()){

              $calorie  = 50;
              $proetin  = 40;
              $glucide  = 30;
              $lipid    = 20;
              
              $calorieTotal  += $calorie;
              $proetinTotal  += $proetin;
              $glucideTotal  += $glucide;
              $lipidTotal    += $lipid;
        
              $distriXNutritionMyRecipeFoodData->setCalorie($calorie);
              $distriXNutritionMyRecipeFoodData->setProetin($proetin);
              $distriXNutritionMyRecipeFoodData->setGlucide($glucide);
              $distriXNutritionMyRecipeFoodData->setLipid($lipid);

            }
          }
          
          
          $distriXNutritionMyRecipeFoodData->setNameFood($food->getName());
          break;
        }
      }
      
      $distriXNutritionMyRecipeFoodData->setWeight($recipeFood->getWeight());
      $distriXNutritionMyRecipeFoodData->setIdWeightType($recipeFood->getIdWeightType());
      
      foreach ($listWeightsTypes as $weightType) {
        if($recipeFood->getIdWeightType() == $weightType->getId()){
          $distriXNutritionMyRecipeFoodData->setNameWeightType($weightType->getName());
          $distriXNutritionMyRecipeFoodData->setAbbrWeightType($weightType->getAbbreviation());
          break;
        }
      }


      $distriXNutritionMyRecipeFoodData->setElemState($recipeFood->getElemState());
      $distriXNutritionMyRecipeFoodData->setTimestamp($recipeFood->getTimestamp());
      $nutritionalInfo[] = $distriXNutritionMyRecipeFoodData;
      break;
    }
  }
  $distriXNutritionMyRecipeData->setNutritionalInfo($nutritionalInfo);
  
  $distriXNutritionMyRecipeData->setCalorie($calorieTotal);
  $distriXNutritionMyRecipeData->setProetin($proetinTotal);
  $distriXNutritionMyRecipeData->setGlucide($glucideTotal);
  $distriXNutritionMyRecipeData->setLipid($lipidTotal);
  
  $listMyRecipesFormFront[] = $distriXNutritionMyRecipeData;
}

$resp["ListMyRecipes"]  = $listMyRecipesFormFront;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
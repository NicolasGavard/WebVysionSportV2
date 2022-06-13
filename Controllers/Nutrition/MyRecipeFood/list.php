<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyRecipes/DistriXNutritionRecipeData.php");
include(__DIR__ . "/../../Data/Nutrition/MyRecipeFood/DistriXNutritionRecipeFoodData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodFoodData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodNutritionalData.php");
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");
include(__DIR__ . "/../../Data/CodeTables/WeightType/DistriXCodeTableWeightTypeData.php");

$listMyRecipesFoodFormFront = [];
$listMyRecipesFoods         = [];
$listFoods                  = [];
$listWeightsTypes           = [];
$listNutritionals           = [];

$_POST['idRecipe']          = 1;

$infoProfil = DistriXStyAppInterface::getUserInformation();
$distriXCodeTableLanguageData = new DistriXCodeTableLanguageData();
$distriXCodeTableLanguageData->setId($infoProfil->getIdLanguage());

$distriXNutritionRecipeData = new DistriXNutritionRecipeData();
$distriXNutritionRecipeData->setId($_POST['idRecipe']);

list($distriXNutritionRecipeFoodData, $errorJson)     = DistriXNutritionRecipeFoodData::getJsonData($_POST);

// CALL
$recipeCaller = new DistriXServicesCaller();
$recipeCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesViewDataSvc.php");
$recipeCaller->addParameter("data", $distriXNutritionRecipeData);

$recipeFoodCaller = new DistriXServicesCaller();
$recipeFoodCaller->setServiceName("Nutrition/RecipeFood/DistriXNutritionMyRecipeFoodsListDataSvc.php");
$recipeFoodCaller->addParameter("data", $distriXNutritionRecipeFoodData);

$foodCaller = new DistriXServicesCaller();
$foodCaller->setServiceName("Food/Food/DistriXFoodListDataSvc.php");
$foodCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);

$foodNutritionalCaller = new DistriXServicesCaller();
$foodNutritionalCaller->setServiceName("Food/FoodNutritional/DistriXFoodNutritionalListDataSvc.php");

$weightTypeCaller = new DistriXServicesCaller();
$weightTypeCaller->setServiceName("TablesCodes/WeightType/DistriXWeightTypeListDataSvc.php");
$weightTypeCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);

$nutritionalCaller = new DistriXServicesCaller();
$nutritionalCaller->setServiceName("TablesCodes/Nutritional/DistriXNutritionalListDataSvc.php");
$nutritionalCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);

$svc = new DistriXSvc();
$svc->addToCall("recipe", $recipeCaller);
$svc->addToCall("recipeFood", $recipeFoodCaller);
$svc->addToCall("food", $foodCaller);
$svc->addToCall("foodNutritional", $foodNutritionalCaller);
$svc->addToCall("weightType", $weightTypeCaller);
$svc->addToCall("nutritional", $nutritionalCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("recipe"); //print_r($output);
if ($outputok && isset($output["ViewMyRecipe"]) && is_array($output["ViewMyRecipe"])) {
  list($infoMyRecipe, $jsonError) = DistriXNutritionRecipeData::getJsonData($output["ViewMyRecipe"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("recipeFood"); //print_r($output);
if ($outputok && isset($output["ListMyRecipeFoods"]) && is_array($output["ListMyRecipeFoods"])) {
  list($listMyRecipesFoods, $jsonError) = DistriXNutritionRecipeFoodData::getJsonArray($output["ListMyRecipeFoods"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("food"); //print_r($output);
if ($outputok && isset($output["ListFoods"]) && is_array($output["ListFoods"])) {
  list($listFoods, $jsonError) = DistriXFoodFoodData::getJsonArray($output["ListFoods"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("foodNutritional"); //print_r($output);
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


$calorieTotal     = $proetinTotal = $glucideTotal = $lipidTotal = $vitaminTotal = $traceElementTotal = $mineralTotal = 0;
$nutritionalInfo  = [];
foreach ($listMyRecipesFoods as $recipeFood) {
  $distriXNutritionMyRecipeFoodData = new DistriXNutritionRecipeFoodData();
  $distriXNutritionMyRecipeFoodData->setId($recipeFood->getId());
  $distriXNutritionMyRecipeFoodData->setIdRecipe($recipeFood->getIdRecipe());
  $distriXNutritionMyRecipeFoodData->setNameRecipe($recipeFood->getNameRecipe());
  $distriXNutritionMyRecipeFoodData->setIdFood($recipeFood->getIdFood());
  
  foreach ($listFoods as $food) {
    if($recipeFood->getIdFood() == $food->getId()){
      $calorie = $proetin = $glucide = $lipid = $vitamin = $traceElement = $mineral = 0;
      foreach ($listFoodNutritionals as $foodNutritinal) {
        if ($food->getId() == $foodNutritinal->getIdFood()){
          foreach ($listNutritionals as $nutritinal) {
            if ($foodNutritinal->getIdNutritional() == $nutritinal->getId()){
              if ($nutritinal->getIsCalorie())      { $calorie      += $foodNutritinal->getNutritional(); break;}
              if ($nutritinal->getIsProetin())      { $proetin      += $foodNutritinal->getNutritional(); break;}
              if ($nutritinal->getIsGlucide())      { $glucide      += $foodNutritinal->getNutritional(); break;}
              if ($nutritinal->getIsLipid())        { $lipid        += $foodNutritinal->getNutritional(); break;}
              if ($nutritinal->getIsVitamin())      { $vitamin      += $foodNutritinal->getNutritional(); break;}
              if ($nutritinal->getIsTraceElement()) { $traceElement += $foodNutritinal->getNutritional(); break;}
              if ($nutritinal->getIsMineral())      { $mineral      += $foodNutritinal->getNutritional(); break;}
            }
          }

          $distriXNutritionMyRecipeFoodData->setCalorie($calorie);
          $distriXNutritionMyRecipeFoodData->setProetin($proetin);
          $distriXNutritionMyRecipeFoodData->setGlucide($glucide);
          $distriXNutritionMyRecipeFoodData->setLipid($lipid);

          $calorieTotal  += $calorie;
          $proetinTotal  += $proetin;
          $glucideTotal  += $glucide;
          $lipidTotal    += $lipid;
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
  $listMyRecipesFoodFormFront[] = $distriXNutritionMyRecipeFoodData;
}

$resp["InfoMyRecipesFood"]  = $infoMyRecipe;
$resp["ListMyRecipesFood"]  = $listMyRecipesFoodFormFront;
$resp["ListFood"]           = $listFoods;
$resp["ListWeightType"]     = $listWeightsTypes;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
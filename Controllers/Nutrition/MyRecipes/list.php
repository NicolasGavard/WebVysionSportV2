<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyRecipes/DistriXNutritionRecipeData.php");
include(__DIR__ . "/../../Data/Nutrition/MyRecipes/DistriXNutritionRecipeFoodData.php");

$listMyRecipesFormFront  = [];
$listMyRecipes           = [];
$listMyRecipesFoods      = [];
list($distriXNutritionRecipeData, $errorJson)     = DistriXNutritionRecipeData::getJsonData($_POST);

$infoProfil = DistriXStyAppInterface::getUserInformation();
$distriXNutritionRecipeData->setIdUserCoach($infoProfil->getId());

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesListDataSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionRecipeData);

// CALL
$receipeCaller = new DistriXServicesCaller();
$receipeCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesListDataSvc.php");
$receipeCaller->addParameter("data", $distriXNutritionRecipeData);

$recipeFoodCaller = new DistriXServicesCaller();
$recipeFoodCaller->setServiceName("Nutrition/RecipeFood/DistriXNutritionMyRecipesFoodsListDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("receipe", $receipeCaller);
$svc->addToCall("recipeFood", $recipeFoodCaller);
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

  $nutritionalInfo = [];
  foreach ($listMyRecipesFoods as $recipeFood) {
    if($recipe->getId() == $recipeFood->getIdRecipe()){
      $distriXNutritionMyRecipeFoodData = new DistriXNutritionRecipeFoodData();
      $distriXNutritionMyRecipeFoodData->setId($recipeFood->getId());
      $distriXNutritionMyRecipeFoodData->setIdRecipe($recipeFood->getIdRecipe());
      $distriXNutritionMyRecipeFoodData->setNameRecipe($recipeFood->getNameRecipe());
      $distriXNutritionMyRecipeFoodData->setIdFood($recipeFood->getIdFood());
      $distriXNutritionMyRecipeFoodData->setNameFood($recipeFood->getNameFood());
      $distriXNutritionMyRecipeFoodData->setWeight($recipeFood->getWeight());
      $distriXNutritionMyRecipeFoodData->setWeightType($recipeFood->getWeightType());
      $distriXNutritionMyRecipeFoodData->setNameWeightType($recipeFood->getNameWeightType());
      $distriXNutritionMyRecipeFoodData->setAbbrWeightType($recipeFood->getAbbrWeightType());
      $distriXNutritionMyRecipeFoodData->setCalorie($recipeFood->getCalorie());
      $distriXNutritionMyRecipeFoodData->setProetin($recipeFood->getProetin());
      $distriXNutritionMyRecipeFoodData->setGlucide($recipeFood->getGlucide());
      $distriXNutritionMyRecipeFoodData->setLipid($recipeFood->getLipid());
      $distriXNutritionMyRecipeFoodData->setElemState($recipeFood->getElemState());
      $distriXNutritionMyRecipeFoodData->setTimestamp($recipeFood->getTimestamp());
      $nutritionalInfo[] = $distriXNutritionMyRecipeFoodData;
    }
  }
  $distriXNutritionMyRecipeData->setNutritionalInfo($nutritionalInfo);
  $listMyRecipesFormFront[] = $distriXNutritionMyRecipeData;
}

$resp["ListMyRecipes"]  = $listMyRecipesFormFront;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
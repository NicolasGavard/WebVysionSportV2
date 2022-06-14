<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyRecipes/DistriXNutritionRecipeData.php");

$recipe  = new DistriXNutritionRecipeData();
if ($_POST['id'] > 0) {
  $recipe->setId($_POST['id']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewMyRecipe");
$servicesCaller->addParameter("data", $recipe);
$servicesCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_MyRecipe", "DistriXNutritionMyRecipesViewDataSvc", "ViewMyRecipe", $output);

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewMyRecipe"])) {
    $recipe = $output["ViewMyRecipe"];
  }
} else {
  $error = $errorData;
}

$resp["ViewMyRecipe"]  = $recipe;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
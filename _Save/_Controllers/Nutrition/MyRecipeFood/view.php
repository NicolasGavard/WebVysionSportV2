<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyRecipeFood/DistriXNutritionRecipeFoodData.php");

$_POST['id'] = 1;

$recipe  = new DistriXNutritionRecipeFoodData();
if ($_POST['id'] > 0) {
  $recipe->setIdRecipe($_POST['id']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewMyRecipeFood");
$servicesCaller->addParameter("data", $recipe);
$servicesCaller->setServiceName("Nutrition/RecipeFood/DistriXNutritionMyRecipesFoodViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_MyRecipeFood", "DistriXNutritionMyRecipesFoodViewDataSvc", "ViewMyRecipeFood", $output);

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewMyRecipeFood"])) {
    $recipe = $output["ViewMyRecipeFood"];
  }
} else {
  $error = $errorData;
}

$resp["ViewMyRecipe"]  = $recipe;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
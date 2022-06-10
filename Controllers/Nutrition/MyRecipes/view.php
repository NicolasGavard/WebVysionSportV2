<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyRecipes/DistriXNutritionRecipeData.php");

$label  = new DistriXNutritionRecipeData();
if ($_POST['id'] > 0) {
  $label->setId($_POST['id']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewMyRecipe");
$servicesCaller->addParameter("data", $label);
$servicesCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_MyRecipe", "DistriXNutritionMyRecipesViewDataSvc", "ViewMyRecipe", $output);

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewMyRecipe"])) {
    $label = $output["ViewMyRecipe"];
  }
} else {
  $error = $errorData;
}

$resp["ViewMyRecipe"]  = $label;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
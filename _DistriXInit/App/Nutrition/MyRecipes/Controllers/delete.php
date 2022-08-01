<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXNutritionRecipeData.php");

$confirmSave  = false;

if (isset($_POST)) {
  $recipe  = new DistriXNutritionRecipeData();
  if (isset($_POST['id']) && $_POST['id'] > 0) {
    $recipe->setId($_POST['id']);
  }
  
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $recipe);
  $servicesCaller->setServiceName("App/Nutrition/MyRecipe/Services/DistriXNutritionMyRecipesDeleteDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
  
  $logOk = logController("Security_MyRecipe", "DistriXNutritionMyRecipesDeleteDataSvc", "DelMyRecipe", $output);
  
  if ($outputok && isset($output["ConfirmSave"]) && $output["ConfirmSave"]) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
  
  $resp["ConfirmSave"]  = $confirmSave;
  if(!empty($error)){
    $resp["Error"]        = $error;
  }
  
  echo json_encode($resp);
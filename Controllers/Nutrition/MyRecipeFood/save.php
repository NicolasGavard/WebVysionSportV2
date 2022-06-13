<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyRecipeFood/DistriXNutritionRecipeFoodData.php");

$confirmSave  = false;

list($distriXNutritionMyRecipeFoodData, $errorJson) = DistriXNutritionRecipeFoodData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $distriXNutritionMyRecipeFoodData);
$servicesCaller->setServiceName("Nutrition/RecipeFood/DistriXNutritionMyRecipeFoodsSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_MyRecipe", "DistriXNutritionMyRecipesFoodSaveDataSvc", "SaveMyRecipeFood", $output);

if ($outputok && isset($output["ConfirmSave"]) && $output["ConfirmSave"]) {
  $confirmSave = $output["ConfirmSave"];
} else {
  $error = $errorData;
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
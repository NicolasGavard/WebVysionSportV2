<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyRecipes/DistriXNutritionRecipeData.php");

$confirmSave  = false;

list($distriXNutritionMyRecipeData, $errorJson) = DistriXNutritionRecipeData::getJsonData($_POST);
if($_POST['base64Img'] != '') { $distriXNutritionMyRecipeData->setLinkToPicture($_POST['base64Img']);}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $distriXNutritionMyRecipeData);
$servicesCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_MyRecipe", "DistriXNutritionMyRecipesSaveDataSvc", "SaveMyRecipe", $output);

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
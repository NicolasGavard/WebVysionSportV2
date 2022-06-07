<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyRecipes/DistriXNutritionRecipeData.php");

$listRecipes          = [];
list($distriXNutritionRecipeData, $errorJson)     = DistriXNutritionRecipeData::getJsonData($_POST);

$infoProfil = DistriXStyAppInterface::getUserInformation();
$distriXNutritionRecipeData->setIdUserCoach($infoProfil->getId());

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesListDataSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionRecipeData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

$logOk = logController("Security_MyRecipes", "DistriXNutritionMyRecipesListDataSvc", "ListMyRecipes", $output);

if ($outputok && isset($output["ListMyRecipes"]) && is_array($output["ListMyRecipes"])) {
  list($listRecipes, $jsonError) = DistriXNutritionRecipeData::getJsonArray($output["ListMyRecipes"]);
} else {
  $error                = $errorData;
  $resp["Error"]        = $error;
}

$resp["ListMyRecipes"]  = $listRecipes;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
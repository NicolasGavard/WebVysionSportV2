<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// STY APP
include(__DIR__ . "/../../../DistriXSvc/DistriXSvcUtil.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyRecipes/DistriXNutritionRecipeData.php");
include(__DIR__ . "/../../Data/Food/Food/DistriXFoodFoodData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp               = [];
$error              = [];
$output             = [];
$outputok           = false;

$listRecipesFormFront = [];
$listRecipes          = [];
$listFoods            = [];

list($distriXNutritionRecipeData, $errorJson) = DistriXNutritionRecipeData::getJsonData($_POST);
list($distriXFoodFoodData, $errorJson)        = DistriXFoodFoodData::getJsonData($_POST);

// CALL
$templateDietCaller = new DistriXServicesCaller();
$templateDietCaller->setServiceName("Nutrition/Recipe/DistriXNutritionMyRecipesListDataSvc.php");
$templateDietCaller->addParameter("data", $distriXNutritionRecipeData);

$currentDietCaller = new DistriXServicesCaller();
$currentDietCaller->setServiceName("Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$currentDietCaller->addParameter("data", $distriXFoodFoodData);

$svc = new DistriXSvc();
$svc->addToCall("templateDiet", $templateDietCaller);
$svc->addToCall("currentDiet", $currentDietCaller);
$callsOk = $svc->call();


list($outputok, $output, $errorData) = $svc->getResult("templateDiet"); //print_r($output);
if ($outputok && isset($output["ListMyRecipes"]) && is_array($output["ListMyRecipes"])) {
  list($listRecipes, $jsonError) = DistriXNutritionRecipeData::getJsonArray($output["ListMyRecipes"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("currentDiet"); //print_r($output);
if ($outputok && isset($output["ListMyCurrentsDiets"]) && is_array($output["ListMyCurrentsDiets"])) {
  list($listMyCurrentDiets, $jsonError) = DistriXFoodFoodData::getJsonArray($output["ListMyCurrentsDiets"]);
} else {
  $error = $errorData;
}

foreach ($listRecipes as $templateDiet) {
  $distriXNutritionRecipeData = new DistriXNutritionRecipeData();
  $distriXNutritionRecipeData->setId($templateDiet->getId());
  $distriXNutritionRecipeData->setIdUserCoach($templateDiet->getIdUserCoach());
  $distriXNutritionRecipeData->setName($templateDiet->getName());
  $distriXNutritionRecipeData->setDuration($templateDiet->getDuration());
  $distriXNutritionRecipeData->setTags($templateDiet->getTags());

  $nbStudentAssigned = 0;
  foreach ($listMyCurrentDiets as $currentDiet) {
    if ($templateDiet->getId() == $currentDiet->getIdDietTemplate()){
      $nbStudentAssigned++;
    }
  }
  $distriXNutritionRecipeData->setNbStudentAssigned($nbStudentAssigned);
  
  $distriXNutritionRecipeData->setElemState($templateDiet->getElemState());
  $distriXNutritionRecipeData->setTimestamp($templateDiet->getTimestamp());
  $listRecipesFormFront[] = $distriXNutritionRecipeData;
}

$resp["ListMyRecipes"] = $listRecipesFormFront;
if(!empty($error)){
  $resp["Error"]              = $error;
}

echo json_encode($resp);
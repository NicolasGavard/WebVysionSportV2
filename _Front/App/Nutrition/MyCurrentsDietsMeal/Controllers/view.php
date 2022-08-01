<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Nutrition/MyCurrentsDiets/DistriXNutritionCurrentDietData.php");

list($distriXNutritionCurrentDietData, $errorJson)  = DistriXNutritionCurrentDietData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewMyCurrentDiet");
$servicesCaller->addParameter("data", $distriXNutritionCurrentDietData);
$servicesCaller->setServiceName("App/Nutrition/MyCurrentsDiets/Services/DistriXNutritionMyCurrentsDietsViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_CurrentDiet", "DistriXMyCurrentDietViewDataSvc", "ViewMyCurrentDiet", $output);

if ($outputok && isset($output["ViewMyCurrentDiet"])) {
  list($currentDiet, $jsonError) = DistriXNutritionCurrentDietData::getJsonData($output["ViewMyCurrentDiet"]);
} else {
  $error = $errorData;
}

$resp["ViewMyCurrentDiet"]  = $currentDiet;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
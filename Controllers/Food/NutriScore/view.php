<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Food/DistriXFoodNutriScoreData.php");

list($distriXFoodNutriScoreData, $errorJson) = DistriXFoodNutriScoreData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewNutriScore");
$servicesCaller->addParameter("data", $distriXFoodNutriScoreData);
$servicesCaller->setServiceName("Food/NutriScore/DistriXFoodNutriScoreViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_NutriScore", "DistriXNutriScoreViewDataSvc", "ViewNutriScore", $output);

if ($outputok && isset($output["ViewNutriScore"])) {
  $distriXFoodNutriScoreData = $output["ViewNutriScore"];
} else {
  $error = $errorData;
}

$resp["ViewNutriScore"]  = $distriXFoodNutriScoreData;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
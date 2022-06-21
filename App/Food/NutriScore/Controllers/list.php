<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodNutriScoreData.php");

$listNutriScores = [];

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListNutriScores");
$servicesCaller->setServiceName("Food/NutriScore/DistriXFoodNutriScoreListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

$logOk = logController("Security_NutriScore", "DistriXNutriScoreListDataSvc", "ListNutriScores", $output);

if ($outputok && isset($output["ListNutriScores"]) && is_array($output["ListNutriScores"])) {
  list($listNutriScores, $jsonError) = DistriXFoodNutriScoreData::getJsonArray($output["ListNutriScores"]);
} else {
  $error              = $errorData;
  $resp["Error"]      = $error;
}

$resp["ListNutriScores"]   = $listNutriScores;

echo json_encode($resp);
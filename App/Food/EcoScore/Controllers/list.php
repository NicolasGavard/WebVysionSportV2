<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodEcoScoreData.php");

$listEcoScores  = [];
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListEcoScores");
$servicesCaller->setServiceName("Food/EcoScore/DistriXFoodEcoScoreListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

$logOk = logController("Security_EcoScore", "DistriXEcoScoreListDataSvc", "ListEcoScores", $output);

if ($outputok && isset($output["ListEcoScores"]) && is_array($output["ListEcoScores"])) {
  list($listEcoScores, $jsonError) = DistriXFoodEcoScoreData::getJsonArray($output["ListEcoScores"]);
} else {
  $error              = $errorData;
  $resp["Error"]      = $error;
}

$resp["ListEcoScores"]   = $listEcoScores;

echo json_encode($resp);
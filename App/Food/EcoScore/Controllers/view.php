<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodEcoScoreData.php");

list($distriXFoodEcoScoreData, $errorJson) = DistriXFoodEcoScoreData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewEcoScore");
$servicesCaller->addParameter("data", $distriXFoodEcoScoreData);
$servicesCaller->setServiceName("Food/EcoScore/DistriXFoodEcoScoreViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_EcoScore", "DistriXEcoScoreViewDataSvc", "ViewEcoScore", $output);

if ($outputok && isset($output["ViewEcoScore"])) {
  $distriXFoodEcoScoreData = $output["ViewEcoScore"];
} else {
  $error = $errorData;
}

$resp["ViewEcoScore"]  = $distriXFoodEcoScoreData;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
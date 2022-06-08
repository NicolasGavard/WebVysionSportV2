<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Food/DistriXFoodNovaScoreData.php");

$resp              = array();
$error             = array();
$output            = array();
$outputok          = false;

list($distriXFoodNovaScoreData, $errorJson) = DistriXFoodNovaScoreData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewNovaScore");
$servicesCaller->addParameter("data", $distriXFoodNovaScoreData);
$servicesCaller->setServiceName("Food/NovaScore/DistriXFoodNovaScoreViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_NovaScore", "DistriXNovaScoreViewDataSvc", "ViewNovaScore", $output);

if ($outputok && isset($output["ViewNovaScore"])) {
  $distriXFoodNovaScoreData = $output["ViewNovaScore"];
} else {
  $error = $errorData;
}

$resp["ViewNovaScore"]  = $distriXFoodNovaScoreData;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
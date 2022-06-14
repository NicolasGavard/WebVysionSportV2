<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
// DATA
include(__DIR__ . "/../../Data/Food/DistriXFoodFoodData.php");

$food  = new DistriXFoodFoodData();
if ($_POST['id'] > 0) {
  $food->setId($_POST['id']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewFood");
$servicesCaller->addParameter("data", $food);
$servicesCaller->setServiceName("Food/Food/DistriXFoodViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Food", "DistriXFoodViewDataSvc", "ViewFood", $output);

if ($outputok && isset($output["ViewFood"])) {
  list($food, $jsonError) = DistriXFoodFoodData::getJsonData($output["ViewFood"]);
} else {
  $error = $errorData;
}

$resp["ViewFood"]  = $food;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
// DATA
include(__DIR__ . "/../../Data/DistriXFoodFoodData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp              = array();
$error             = array();
$output            = array();
$outputok          = false;

$food  = new DistriXFoodFoodData();
if ($_POST['id'] > 0) {
  $food->setId($_POST['id']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewFood");
$servicesCaller->addParameter("data", $food);
$servicesCaller->setServiceName("Food/Food/DistriXFoodViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewFood"])) {
    $food = $output["ViewFood"];
  }
} else {
  $error = $errorData;
}

$resp["ViewFood"]  = $food;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
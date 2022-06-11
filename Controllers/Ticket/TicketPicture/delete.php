<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Ticket/Ticket/DistriXCodeTableFoodTypeData.php");

$confirmSave = false;

if (isset($_POST)) {
  list($foodType, $errorJson) = DistriXCodeTableFoodTypeData::getJsonData($_POST);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $foodType);
  $servicesCaller->setServiceName("TablesCodes/FoodType/DistriXFoodTypeDeleteDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  //print_r($output);

  $logOk = logController("Security_FoodType", "DistriXFoodTypeDeleteDataSvc", "DelFoodType", $output);

  if ($outputok && !empty($output) && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
}
$resp["confirmSave"] = $confirmSave;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
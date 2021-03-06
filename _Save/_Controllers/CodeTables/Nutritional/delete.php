<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalData.php");

$confirmSave = false;

if (isset($_POST)) {
  list($nutritional, $errorJson) = DistriXCodeTableNutritionalData::getJsonData($_POST);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $nutritional);
  $servicesCaller->setServiceName("TablesCodes/Nutritional/DistriXNutritionalDeleteDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  //print_r($output);

  $logOk = logController("Security_Nutritional", "DistriXNutritionalDeleteDataSvc", "DelNutritional", $output);

  if ($outputok && !empty($output) && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
}
$resp["ConfirmSave"] = $confirmSave;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
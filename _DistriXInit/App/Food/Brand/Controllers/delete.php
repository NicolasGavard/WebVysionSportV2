<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodBrandData.php");

$confirmSave  = false;

if (isset($_POST)) {
  list($distriXFoodBandData, $errorJson) = DistriXFoodBrandData::getJsonData($_POST);
  
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $distriXFoodBandData);
  $servicesCaller->setServiceName("App/Food/Brand/Services/DistriXFoodBrandDeleteDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
  
  $logOk = logController("Security_Brand", "DistriXFoodBrandDeleteDataSvc", "DelBrand", $output);
  
  if ($outputok && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
}

$resp["ConfirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
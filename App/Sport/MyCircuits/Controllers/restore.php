<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCircuitTemplateData.php");

$confirmSave  = false;

if (isset($_POST)) {
  $circuitTemplate = new DistriXCircuitTemplateData();
  $circuitTemplate->setId($_POST['id'] ?? 0);
  
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $circuitTemplate);
  $servicesCaller->setServiceName("App/Sport/MyCircuits/Services/DistriXSportMyCircuitsTemplateRestoreDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
  
  $logOk = logController("Security_CircuitTemplate", "DistriXCircuitTemplateRestoreDataSvc", "RestoreCircuitTemplate", $output);
  
  if ($outputok && !empty($output) > 0) {
    if (isset($output["ConfirmSave"])) {
      $confirmSave = $output["ConfirmSave"];
    }
  } else {
    $error = $errorData;
  }
}

$resp["ConfirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
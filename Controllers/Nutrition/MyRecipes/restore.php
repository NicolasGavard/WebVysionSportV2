<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyTemplatesDiets/DistriXNutritionTemplateDietData.php");

$confirmSave  = false;

if (isset($_POST)) {
  $label  = new DistriXNutritionTemplateDietData();
  if (isset($_POST['id']) && $_POST['id'] > 0) {
    $label->setId($_POST['id']);
  }
  
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setMethodName("RestoreTemplateDiet");
  $servicesCaller->addParameter("data", $label);
  $servicesCaller->setServiceName("Nutrition/TemplateDiet/DistriXNutritionMyTemplatesDietsRestoreDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
  
  $logOk = logController("Security_Recipe", "DistriXTemplateDietRestoreDataSvc", "RestoreTemplateDiet", $output);
  
  if ($outputok && isset($output["ConfirmSave"]) && $output["ConfirmSave"]) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
  
  $resp["confirmSave"]  = $confirmSave;
  if(!empty($error)){
    $resp["Error"]        = $error;
  }
  
  echo json_encode($resp);
<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXSportMyExercisesData.php");

$confirmSave  = false;

if (isset($_POST)) {
  $currentDiet = new DistriXSportMyExercisesData();
  $currentDiet->setId($_POST['id'] ?? 0);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $currentDiet);
  $servicesCaller->setServiceName("App/Nutrition/MyCurrentsDiets/Services/DistriXNutritionMyCurrentsDietsDeleteDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
  
  $logOk = logController("Security_CurrentDiet", "DistriXCurrentDietDeleteDataSvc", "DelCurrentDiet", $output);
  
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
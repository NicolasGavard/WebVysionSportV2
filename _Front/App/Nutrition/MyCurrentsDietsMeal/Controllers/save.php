<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Nutrition/MyCurrentsDiets/DistriXNutritionCurrentDietData.php");

$confirmSave  = false;

$date               = $_POST['dateStart'];
$newDate            = date("Ymd", strtotime($date));
$_POST['dateStart'] = $newDate;
list($distriXNutritionCurrentDietData, $errorJson) = DistriXNutritionCurrentDietData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveCurrentDiet");
$servicesCaller->addParameter("data", $distriXNutritionCurrentDietData);
$servicesCaller->setServiceName("Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_CurrentDiet", "DistriXDietSaveDataSvc", "SaveCurrentDiet", $output);

if ($outputok && isset($output["ConfirmSave"]) && $output["ConfirmSave"]) {
  $confirmSave = $output["ConfirmSave"];
} else {
  $error = $errorData;
}

$resp["ConfirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXNutritionCurrentDietData.php");

$confirmSave  = false;

$idDiet             = 0;
$date               = $_POST['dateStart'];
$newDate            = date("Ymd", strtotime($date));
$_POST['dateStart'] = $newDate;
list($distriXNutritionCurrentDietData, $errorJson) = DistriXNutritionCurrentDietData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $distriXNutritionCurrentDietData);
$servicesCaller->setServiceName("App/Nutrition/MyCurrentsDiets/Services/DistriXNutritionMyCurrentsDietsSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); var_dump($output);

$logOk = logController("Security_CurrentDiet", "DistriXDietSaveDataSvc", "SaveCurrentDiet", $output);

if ($outputok && isset($output["ConfirmSave"]) && $output["ConfirmSave"]) {
  $confirmSave  = $output["ConfirmSave"];
  $idDiet       = $output["idDiet"];
} else {
  $error = $errorData;
}

$resp["ConfirmSave"]  = $confirmSave;
if ($_POST['id'] > 0)  {
  $resp["idDiet"]     = $idDiet;
}
if (!empty($error)) {
  $resp["Error"]      = $error;
}

echo json_encode($resp);
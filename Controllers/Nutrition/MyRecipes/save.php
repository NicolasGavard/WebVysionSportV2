<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyTemplatesDiets/DistriXNutritionTemplateDietData.php");

$confirmSave  = false;

$distriXNutritionTemplateDietData = new DistriXNutritionTemplateDietData();
$distriXNutritionTemplateDietData->setId($_POST['id']);
$distriXNutritionTemplateDietData->setIdUser($_POST['id']);
$distriXNutritionTemplateDietData->setIdDietTemplace($_POST['id']);
$distriXNutritionTemplateDietData->setDateStart($_POST['dateStart']);
$distriXNutritionTemplateDietData->setStatus($_POST['statut']);
$distriXNutritionTemplateDietData->setTimestamp($_POST['timestamp']);


$distriXCodeTableDietData = new DistriXFoodDietData();
$distriXCodeTableDietData->setId($_POST['id']);
$distriXCodeTableDietData->setName($_POST['name']);
$distriXCodeTableDietData->setLinkToPicture('');
if($_POST['base64Img'] != '') { $distriXCodeTableDietData->setLinkToPicture($_POST['base64Img']);}
$distriXCodeTableDietData->setTimestamp($_POST['timestamp']);
$distriXCodeTableDietData->setStatus($_POST['statut']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveDiet");
$servicesCaller->addParameter("data", $distriXCodeTableDietData);
$servicesCaller->setServiceName("Food/Diet/DistriXFoodDietSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_CurrentDiet", "DistriXDietSaveDataSvc", "SaveDiet", $output);

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
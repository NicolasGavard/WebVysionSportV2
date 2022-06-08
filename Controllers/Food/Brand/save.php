<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Food/DistriXFoodBrandData.php");

$confirmSave  = false;

if ($_POST["base64Img"] != '') {
  $_POST["linkToPicture"] = $_POST["base64Img"];
}
list($distriXFoodBandData, $errorJson) = DistriXFoodBrandData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveBrand");
$servicesCaller->addParameter("data", $distriXFoodBandData);
$servicesCaller->setServiceName("Food/Brand/DistriXFoodBrandSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Brand", "DistriXBrandSaveDataSvc", "SaveBrand", $output);

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
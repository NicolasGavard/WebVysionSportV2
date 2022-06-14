<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Food/DistriXFoodBrandData.php");

list($distriXFoodBandData, $errorJson) = DistriXFoodBrandData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewBrand");
$servicesCaller->addParameter("data", $distriXFoodBandData);
$servicesCaller->setServiceName("Food/Brand/DistriXFoodBrandViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Brand", "DistriXBrandViewDataSvc", "ViewBrand", $output);

if ($outputok && isset($output["ViewBrand"])) {
  list($brand, $jsonError) = DistriXFoodBrandData::getJsonData($output["ViewBrand"]);
} else {
  $error = $errorData;
}

$resp["ViewBrand"]  = $brand;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
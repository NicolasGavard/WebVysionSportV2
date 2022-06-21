<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Food/DistriXFoodBrandData.php");

$listBrands     = [];
$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListBrands");
$servicesCaller->setServiceName("Food/Brand/DistriXFoodBrandListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

$logOk = logController("Security_Brand", "DistriXFoodBrandListDataSvc", "ListBrands", $output);

if ($outputok && isset($output["ListBrands"]) && is_array($output["ListBrands"])) {
  list($listBrands, $jsonError) = DistriXFoodBrandData::getJsonArray($output["ListBrands"]);
} else {
  $error              = $errorData;
  $resp["Error"]      = $error;
}

$resp["ListBrands"]   = $listBrands;

echo json_encode($resp);
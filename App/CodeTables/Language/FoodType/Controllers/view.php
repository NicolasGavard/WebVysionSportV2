<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableFoodTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableFoodTypeNameData.php");

if (isset($_POST)) {
  list($foodType, $errorJson) = DistriXCodeTableFoodTypeData::getJsonData($_POST);
  $listFoodTypeNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $foodType);
  $servicesCaller->setServiceName("App/CodeTables/FoodType/Services/DistriXFoodTypeViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_FoodType", "DistriXFoodTypeViewDataSvc", "ViewFoodType", $output);

// RESPONSE
  if ($outputok && isset($output["ViewFoodType"])) {
    list($foodType, $jsonError) = DistriXCodeTableFoodTypeData::getJsonData($output["ViewFoodType"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewFoodTypeNames"]) && is_array($output["ViewFoodTypeNames"])) {
    list($listFoodTypeNames, $jsonError) = DistriXCodeTableFoodTypeNameData::getJsonArray($output["ViewFoodTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $foodType->setNames($listFoodTypeNames);
  $foodType->setNbLanguages(count($listFoodTypeNames));
}
$resp["ViewFoodType"] = $foodType;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
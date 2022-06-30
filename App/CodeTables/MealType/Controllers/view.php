<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableMealTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableMealTypeNameData.php");

if (isset($_POST)) {
  list($mealType, $errorJson) = DistriXCodeTableMealTypeData::getJsonData($_POST);
  $listMealTypeNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $mealType);
  $servicesCaller->setServiceName("App/CodeTables/MealType/Services/DistriXMealTypeViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_MealType", "DistriXMealTypeViewDataSvc", "ViewMealType", $output);

// RESPONSE
  if ($outputok && isset($output["ViewMealType"])) {
    list($mealType, $jsonError) = DistriXCodeTableMealTypeData::getJsonData($output["ViewMealType"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewMealTypeNames"]) && is_array($output["ViewMealTypeNames"])) {
    list($listMealTypeNames, $jsonError) = DistriXCodeTableMealTypeNameData::getJsonArray($output["ViewMealTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $mealType->setNames($listMealTypeNames);
  $mealType->setNbLanguages(count($listMealTypeNames));
}
$resp["ViewMealType"] = $mealType;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
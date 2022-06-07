<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/CategoryFoodType/DistriXCodeTableCategoryFoodTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/CategoryFoodType/DistriXCodeTableCategoryFoodTypeNameData.php");

// TESTS
$_POST["id"] = 1;
// $_POST["id"] = 3;
// $_POST["id"] = 4;

if (isset($_POST)) {
  list($foodType, $errorJson) = DistriXCodeTableCategoryFoodTypeData::getJsonData($_POST);
  $listCategoryFoodTypeNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $foodType);
  $servicesCaller->setServiceName("TablesCodes/CategoryFoodType/DistriXCategoryFoodTypeViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_CategoryFoodType", "DistriXCategoryFoodTypeViewDataSvc", "ViewCategoryFoodType", $output);

// RESPONSE
  if ($outputok && isset($output["ViewCategoryFoodType"])) {
    list($foodType, $jsonError) = DistriXCodeTableCategoryFoodTypeData::getJsonData($output["ViewCategoryFoodType"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewCategoryFoodTypeNames"]) && is_array($output["ViewCategoryFoodTypeNames"])) {
    list($listCategoryFoodTypeNames, $jsonError) = DistriXCodeTableCategoryFoodTypeNameData::getJsonArray($output["ViewCategoryFoodTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $foodType->setNames($listCategoryFoodTypeNames);
  $foodType->setNbLanguages(count($listCategoryFoodTypeNames));
}
$resp["ViewCategoryFoodType"] = $foodType;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
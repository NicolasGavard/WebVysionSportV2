<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableCategoryFoodTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableCategoryFoodTypeNameData.php");

if (isset($_POST)) {
  list($categoryFoodType, $errorJson) = DistriXCodeTableCategoryFoodTypeData::getJsonData($_POST);
  $listCategoryFoodTypeNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $categoryFoodType);
  $servicesCaller->setServiceName("App/CodeTables/CategoryFoodType/Services/DistriXCategoryFoodTypeViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_CategoryFoodType", "DistriXCategoryFoodTypeViewDataSvc", "ViewCategoryFoodType", $output);

// RESPONSE
  if ($outputok && isset($output["ViewCategoryFoodType"])) {
    list($categoryFoodType, $jsonError) = DistriXCodeTableCategoryFoodTypeData::getJsonData($output["ViewCategoryFoodType"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewCategoryFoodTypeNames"]) && is_array($output["ViewCategoryFoodTypeNames"])) {
    list($listCategoryFoodTypeNames, $jsonError) = DistriXCodeTableCategoryFoodTypeNameData::getJsonArray($output["ViewCategoryFoodTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $categoryFoodType->setNames($listCategoryFoodTypeNames);
  $categoryFoodType->setNbLanguages(count($listCategoryFoodTypeNames));
}
$resp["ViewCategoryFoodType"] = $categoryFoodType;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
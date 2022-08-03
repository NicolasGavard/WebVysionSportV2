<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/mealType/DistriXCodeTablemealTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/mealType/DistriXCodeTablemealTypeNameData.php");

// TESTS
// $_POST["id"] = 1;
// $_POST["id"] = 3;
// $_POST["id"] = 4;

if (isset($_POST)) {
  list($mealType, $errorJson) = DistriXCodeTablemealTypeData::getJsonData($_POST);
  $listmealTypeNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $mealType);
  $servicesCaller->setServiceName("TablesCodes/mealType/DistriXmealTypeViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_mealType", "DistriXmealTypeViewDataSvc", "ViewmealType", $output);

// RESPONSE
  if ($outputok && isset($output["ViewmealType"])) {
    list($mealType, $jsonError) = DistriXCodeTablemealTypeData::getJsonData($output["ViewmealType"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewmealTypeNames"]) && is_array($output["ViewmealTypeNames"])) {
    list($listmealTypeNames, $jsonError) = DistriXCodeTablemealTypeNameData::getJsonArray($output["ViewmealTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $mealType->setNames($listmealTypeNames);
  $mealType->setNbLanguages(count($listmealTypeNames));
}
$resp["ViewmealType"] = $mealType;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
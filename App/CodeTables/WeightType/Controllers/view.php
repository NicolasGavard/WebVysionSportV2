<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableWeightTypeNameData.php");

if (isset($_POST)) {
  list($weightType, $errorJson) = DistriXCodeTableWeightTypeData::getJsonData($_POST);
  $listWeightTypeNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $weightType);
  $servicesCaller->setServiceName("App/CodeTables/WeightType/Services/DistriXWeightTypeViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_WeightType", "DistriXWeightTypeViewDataSvc", "ViewWeightType", $output);

// RESPONSE
  if ($outputok && isset($output["ViewWeightType"])) {
    list($weightType, $jsonError) = DistriXCodeTableWeightTypeData::getJsonData($output["ViewWeightType"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewWeightTypeNames"]) && is_array($output["ViewWeightTypeNames"])) {
    list($listWeightTypeNames, $jsonError) = DistriXCodeTableWeightTypeNameData::getJsonArray($output["ViewWeightTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $weightType->setNames($listWeightTypeNames);
  $weightType->setNbLanguages(count($listWeightTypeNames));
}
$resp["ViewWeightType"] = $weightType;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
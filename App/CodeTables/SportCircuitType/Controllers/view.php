<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableCircuitTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableCircuitTypeNameData.php");

if (isset($_POST)) {
  list($circuitType, $errorJson) = DistriXCodeTableCircuitTypeData::getJsonData($_POST);
  $listCircuitTypeNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $circuitType);
  $servicesCaller->setServiceName("App/CodeTables/SportCircuitType/Services/DistriXCircuitTypeViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_CircuitType", "DistriXCircuitTypeViewDataSvc", "ViewCircuitType", $output);

// RESPONSE
  if ($outputok && isset($output["ViewCircuitType"])) {
    list($circuitType, $jsonError) = DistriXCodeTableCircuitTypeData::getJsonData($output["ViewCircuitType"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewCircuitTypeNames"]) && is_array($output["ViewCircuitTypeNames"])) {
    list($listCircuitTypeNames, $jsonError) = DistriXCodeTableCircuitTypeNameData::getJsonArray($output["ViewCircuitTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $circuitType->setNames($listCircuitTypeNames);
  $circuitType->setNbLanguages(count($listCircuitTypeNames));
}
$resp["ViewCircuitType"] = $circuitType;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
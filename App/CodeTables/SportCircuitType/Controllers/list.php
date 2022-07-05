<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableCircuitTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableCircuitTypeNameData.php");
include(__DIR__ . "/../../Language/Data/DistriXCodeTableLanguageData.php");

$listCircuitTypes = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");

  $dataName       = new DistriXCodeTableCircuitTypeNameData();
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("App/CodeTables/SportCircuitType/Services/DistriXCircuitTypeListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("CircuitType", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_CircuitType", "DistriXCircuitTypeListDataSvc", "ListCircuitType-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("CircuitType"); //print_r($output);
  $logOk = logController("Security_CircuitType", "DistriXCircuitTypeListDataSvc", "ListCircuitType-CircuitTypes", $output);
  if ($outputok && isset($output["ListCircuitTypes"]) && is_array($output["ListCircuitTypes"])) {
    list($listCircuitTypes, $jsonError) = DistriXCodeTableCircuitTypeData::getJsonArray($output["ListCircuitTypes"]);
  } else {
    $error = $errorData;
  }
  
  if ($outputok && isset($output["ListCircuitTypeNames"]) && is_array($output["ListCircuitTypeNames"])) {
    list($listCircuitTypeNames, $jsonError) = DistriXCodeTableCircuitTypeNameData::getJsonArray($output["ListCircuitTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $nbLanguagesTotal = count($listLanguages);
  foreach ($listCircuitTypes as $circuitType) {
    $circuitType->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listCircuitTypeNames as $circuitTypeName) {
      if ($circuitTypeName->getIdCircuitType() == $circuitType->getId()) {
        $names[] = $circuitTypeName;
      }
    }
    $circuitType->setNames($names);
    $circuitType->setNbLanguages(count($names));
  }
}
$resp["ListCircuitTypes"] = $listCircuitTypes;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

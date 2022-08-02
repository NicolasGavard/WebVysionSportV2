<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableWeightTypeNameData.php");
include(__DIR__ . "/../../Language/Data/DistriXCodeTableLanguageData.php");

$listWeightTypes = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");

  $dataName       = new DistriXCodeTableWeightTypeNameData();
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("App/CodeTables/WeightType/Services/DistriXWeightTypeListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("WeightType", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_WeightType", "DistriXWeightTypeListDataSvc", "ListWeightType-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }
  list($outputok, $output, $errorData) = $svc->getResult("WeightType"); //print_r($output);
  $logOk = logController("Security_WeightType", "DistriXWeightTypeListDataSvc", "ListWeightType-WeightTypes", $output);
  if ($outputok && isset($output["ListWeightTypes"]) && is_array($output["ListWeightTypes"])) {
    list($listWeightTypes, $jsonError) = DistriXCodeTableWeightTypeData::getJsonArray($output["ListWeightTypes"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ListWeightTypeNames"]) && is_array($output["ListWeightTypeNames"])) {
    list($listWeightTypeNames, $jsonError) = DistriXCodeTableWeightTypeNameData::getJsonArray($output["ListWeightTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $nbLanguagesTotal = count($listLanguages);
  foreach ($listWeightTypes as $weightType) {
    $weightType->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listWeightTypeNames as $weightTypeName) {
      if ($weightTypeName->getIdWeightType() == $weightType->getId()) {
        $names[] = $weightTypeName;
      }
    }
    $weightType->setNames($names);
    $weightType->setNbLanguages(count($names));
  }
}

$resp["ListWeightTypes"]  = $listWeightTypes;
$resp["ListLanguages"]    = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

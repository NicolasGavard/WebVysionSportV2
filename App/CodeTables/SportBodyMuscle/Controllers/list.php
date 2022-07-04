<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableBodyMuscleData.php");
include(__DIR__ . "/../Data/DistriXCodeTableBodyMuscleNameData.php");
include(__DIR__ . "/../../Language/Data/DistriXCodeTableLanguageData.php");

$listBodyMuscles = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");

  $dataName       = new DistriXCodeTableBodyMuscleNameData();
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("App/CodeTables/BodyMuscle/Services/DistriXBodyMuscleListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("BodyMuscle", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_BodyMuscle", "DistriXBodyMuscleListDataSvc", "ListBodyMuscle-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("BodyMuscle"); //print_r($output);
  $logOk = logController("Security_BodyMuscle", "DistriXBodyMuscleListDataSvc", "ListBodyMuscle-BodyMuscles", $output);
  if ($outputok && isset($output["ListBodyMuscles"]) && is_array($output["ListBodyMuscles"])) {
    list($listBodyMuscles, $jsonError) = DistriXCodeTableBodyMuscleData::getJsonArray($output["ListBodyMuscles"]);
  } else {
    $error = $errorData;
  }
  
  if ($outputok && isset($output["ListBodyMuscleNames"]) && is_array($output["ListBodyMuscleNames"])) {
    list($listBodyMuscleNames, $jsonError) = DistriXCodeTableBodyMuscleNameData::getJsonArray($output["ListBodyMuscleNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $nbLanguagesTotal = count($listLanguages);
  foreach ($listBodyMuscles as $bodyMuscle) {
    $bodyMuscle->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listBodyMuscleNames as $bodyMuscleName) {
      if ($bodyMuscleName->getIdBodyMuscle() == $bodyMuscle->getId()) {
        $names[] = $bodyMuscleName;
      }
    }
    $bodyMuscle->setNames($names);
    $bodyMuscle->setNbLanguages(count($names));
  }
}
$resp["ListBodyMuscles"] = $listBodyMuscles;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

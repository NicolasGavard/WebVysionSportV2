<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableExerciseTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableExerciseTypeNameData.php");
include(__DIR__ . "/../../Language/Data/DistriXCodeTableLanguageData.php");

$listExerciseTypes = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");

  $dataName       = new DistriXCodeTableExerciseTypeNameData();
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("App/CodeTables/SportExerciseType/Services/DistriXExerciseTypeListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("ExerciseType", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_ExerciseType", "DistriXExerciseTypeListDataSvc", "ListExerciseType-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("ExerciseType"); //print_r($output);
  $logOk = logController("Security_ExerciseType", "DistriXExerciseTypeListDataSvc", "ListExerciseType-ExerciseTypes", $output);
  if ($outputok && isset($output["ListExerciseTypes"]) && is_array($output["ListExerciseTypes"])) {
    list($listExerciseTypes, $jsonError) = DistriXCodeTableExerciseTypeData::getJsonArray($output["ListExerciseTypes"]);
  } else {
    $error = $errorData;
  }
  
  if ($outputok && isset($output["ListExerciseTypeNames"]) && is_array($output["ListExerciseTypeNames"])) {
    list($listExerciseTypeNames, $jsonError) = DistriXCodeTableExerciseTypeNameData::getJsonArray($output["ListExerciseTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $nbLanguagesTotal = count($listLanguages);
  foreach ($listExerciseTypes as $exerciseType) {
    $exerciseType->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listExerciseTypeNames as $exerciseTypeName) {
      if ($exerciseTypeName->getIdExerciseType() == $exerciseType->getId()) {
        $names[] = $exerciseTypeName;
      }
    }
    $exerciseType->setNames($names);
    $exerciseType->setNbLanguages(count($names));
  }
}
$resp["ListExerciseTypes"] = $listExerciseTypes;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

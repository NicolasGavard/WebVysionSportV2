<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableExerciseTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableExerciseTypeNameData.php");

if (isset($_POST)) {
  list($exerciseType, $errorJson) = DistriXCodeTableExerciseTypeData::getJsonData($_POST);
  $listExerciseTypeNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $exerciseType);
  $servicesCaller->setServiceName("App/CodeTables/SportExerciseType/Services/DistriXExerciseTypeViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_ExerciseType", "DistriXExerciseTypeViewDataSvc", "ViewExerciseType", $output);

// RESPONSE
  if ($outputok && isset($output["ViewExerciseType"])) {
    list($exerciseType, $jsonError) = DistriXCodeTableExerciseTypeData::getJsonData($output["ViewExerciseType"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewExerciseTypeNames"]) && is_array($output["ViewExerciseTypeNames"])) {
    list($listExerciseTypeNames, $jsonError) = DistriXCodeTableExerciseTypeNameData::getJsonArray($output["ViewExerciseTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $exerciseType->setNames($listExerciseTypeNames);
  $exerciseType->setNbLanguages(count($listExerciseTypeNames));
}
$resp["ViewExerciseType"] = $exerciseType;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
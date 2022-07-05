<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableBodyMuscleData.php");
include(__DIR__ . "/../Data/DistriXCodeTableBodyMuscleNameData.php");

if (isset($_POST)) {
  list($bodyMuscle, $errorJson) = DistriXCodeTableBodyMuscleData::getJsonData($_POST);
  $listBodyMuscleNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $bodyMuscle);
  $servicesCaller->setServiceName("App/CodeTables/SportBodyMuscle/Services/DistriXBodyMuscleViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_BodyMuscle", "DistriXBodyMuscleViewDataSvc", "ViewBodyMuscle", $output);

// RESPONSE
  if ($outputok && isset($output["ViewBodyMuscle"])) {
    list($bodyMuscle, $jsonError) = DistriXCodeTableBodyMuscleData::getJsonData($output["ViewBodyMuscle"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewBodyMuscleNames"]) && is_array($output["ViewBodyMuscleNames"])) {
    list($listBodyMuscleNames, $jsonError) = DistriXCodeTableBodyMuscleNameData::getJsonArray($output["ViewBodyMuscleNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $bodyMuscle->setNames($listBodyMuscleNames);
  $bodyMuscle->setNbLanguages(count($listBodyMuscleNames));
}
$resp["ViewBodyMuscle"] = $bodyMuscle;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
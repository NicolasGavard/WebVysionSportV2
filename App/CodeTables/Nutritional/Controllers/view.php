<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalNameData.php");

// TESTS
// $_POST["id"] = 1;
// $_POST["id"] = 3;
// $_POST["id"] = 4;

if (isset($_POST)) {
  list($nutritional, $errorJson) = DistriXCodeTableNutritionalData::getJsonData($_POST);
  $listNutritionalNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $nutritional);
  $servicesCaller->setServiceName("TablesCodes/Nutritional/DistriXNutritionalViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_Nutritional", "DistriXNutritionalViewDataSvc", "ViewNutritional", $output);

// RESPONSE
  if ($outputok && isset($output["ViewNutritional"])) {
    list($nutritional, $jsonError) = DistriXCodeTableNutritionalData::getJsonData($output["ViewNutritional"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewNutritionalNames"]) && is_array($output["ViewNutritionalNames"])) {
    list($listNutritionalNames, $jsonError) = DistriXCodeTableNutritionalNameData::getJsonArray($output["ViewNutritionalNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $nutritional->setNames($listNutritionalNames);
  $nutritional->setNbLanguages(count($listNutritionalNames));
}
$resp["ViewNutritional"] = $nutritional;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
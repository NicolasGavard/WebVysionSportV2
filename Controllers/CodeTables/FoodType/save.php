<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/FoodType/DistriXCodeTableFoodTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/FoodType/DistriXCodeTableFoodTypeNameData.php");

$confirmSave  = false;

// UPDATE
$_POST['id'] = 1;
$_POST['code'] = "FEC2";
$_POST['name'] = "Féculents 3";
$_POST['elemState'] = 1;
$_POST['timestamp'] = 4;

$names[0]["id"] = 1;
$names[0]["idfoodtype"] = 1;
$names[0]["idlanguage"] = 1;
$names[0]["name"] = "Féculents Name 3";
$names[0]["elemState"] = 0;
$names[0]["timestamp"] = 0;
$names[1]["id"] = 4;
$names[1]["idfoodtype"] = 1;
$names[1]["idlanguage"] = 2;
$names[1]["name"] = "Starches Name 3";
$names[1]["elemState"] = 0;
$names[1]["timestamp"] = 0;

$_POST['names'] = $names;

// // INSERT
// $_POST['id'] = 0;
// $_POST['code'] = "INS1";
// $_POST['name'] = "Insert 1";
// $_POST['elemState'] = 0;
// $_POST['timestamp'] = 0;

// $names[0]["id"] = 0;
// $names[0]["idfoodtype"] = 0;
// $names[0]["idlanguage"] = 1;
// $names[0]["name"] = "Insertion 1";
// $names[0]["elemState"] = 0;
// $names[0]["timestamp"] = 0;
// $names[1]["id"] = 0;
// $names[1]["idfoodtype"] = 0;
// $names[1]["idlanguage"] = 2;
// $names[1]["name"] = "It's an insertion 1";
// $names[1]["elemState"] = 0;
// $names[1]["timestamp"] = 0;

// $_POST['names'] = $names;

if (isset($_POST)) {
  list($foodType, $jsonError) = DistriXCodeTableFoodTypeData::getJsonData($_POST);
  list($foodTypeNames, $jsonError) = DistriXCodeTableFoodTypeNameData::getJsonArray($foodType->getNames());
  $foodType->setNames([]); // Needed to be sent without an array fulfilled with elements that are not data objects. Yvan 01 June 22

  // print_r($foodType);
  // print_r($foodTypeNames);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $foodType);
  $servicesCaller->addParameter("dataNames", $foodTypeNames);
  $servicesCaller->setServiceName("TablesCodes/FoodType/DistriXFoodTypeSaveDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  echo "--"; print_r($output);

  $logOk = logController("Security_FoodType", "DistriXFoodTypeSaveDataSvc", "SaveFoodType", $output);

  if ($outputok && !empty($output) > 0 && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
}
$resp["confirmSave"] = $confirmSave;
if (!empty($error)){
  $resp["Error"] = $error;
}
echo json_encode($resp);
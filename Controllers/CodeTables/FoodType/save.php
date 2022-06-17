<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/FoodType/DistriXCodeTableFoodTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/FoodType/DistriXCodeTableFoodTypeNameData.php");

$international  = 'CodeTables/codeTableFoodTypeList';
$i18cdlangue    = 'FR';
// If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
include(__DIR__ . "/../../../i18/_i18.php");

$confirmSave  = false;

// UPDATE
// $_POST['id'] = 1;
// $_POST['code'] = "FEC2";
// $_POST['name'] = "Féculents 5";
// $_POST['elemState'] = 1;
// $_POST['timestamp'] = 35;

// $names[0]["id"] = 1;
// $names[0]["idfoodtype"] = 1;
// $names[0]["idlanguage"] = 1;
// $names[0]["name"] = "Féculents Name 5";
// $names[0]["elemState"] = 0;
// $names[0]["timestamp"] = 2;
// $names[1]["id"] = 4;
// $names[1]["idfoodtype"] = 1;
// $names[1]["idlanguage"] = 2;
// $names[1]["name"] = "Starches Name 5";
// $names[1]["elemState"] = 0;
// $names[1]["timestamp"] = 2;

// $_POST['names'] = $names;

// // INSERT
// $_POST['id'] = 0;
// $_POST['code'] = "INS2";
// $_POST['name'] = "Insert 2";
// $_POST['elemState'] = 0;
// $_POST['timestamp'] = 0;

// $names[0]["id"] = 0;
// $names[0]["idfoodtype"] = 0;
// $names[0]["idlanguage"] = 1;
// $names[0]["name"] = "Insertion 2";
// $names[0]["elemState"] = 0;
// $names[0]["timestamp"] = 0;
// $names[1]["id"] = 0;
// $names[1]["idfoodtype"] = 0;
// $names[1]["idlanguage"] = 2;
// $names[1]["name"] = "It's an insertion 2";
// $names[1]["elemState"] = 0;
// $names[1]["timestamp"] = 0;

// $_POST['names'] = $names;

if (isset($_POST)) {
  // print_r($_POST);
  // print_r($foodType);
  // print_r($foodTypeNames);
  // die();

  list($foodType, $jsonError) = DistriXCodeTableFoodTypeData::getJsonData($_POST);
  list($foodTypeNames, $jsonError) = DistriXCodeTableFoodTypeNameData::getJsonArray($foodType->getNames());
  $foodType->setNames([]); // Needed to be sent without an array fulfilled with elements that are not data objects. 01 June 22
  
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setDebugMode(DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE);
  // $servicesCaller->setDebugModeAllLayerOn();
  $servicesCaller->addParameter("data", $foodType);
  $servicesCaller->addParameter("dataNames", $foodTypeNames);
  $servicesCaller->setServiceName("TablesCodes/FoodType/DistriXFoodTypeSaveDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  // echo "-*/-"; print_r($output); echo "-*/-";

  $logOk = logController("Security_FoodType", "DistriXFoodTypeSaveDataSvc", "SaveFoodType", $output);

  if ($outputok && !empty($output) > 0 && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    // $error = $errorData;
    list($error, $jsonError) = ApplicationErrorData::getJsonData($errorData);
    $errorCode = "error_".$error->getCode()."_txt";
    if (isset($$errorCode)) {
      $codes[0] = $foodType->getCode();
      $codes[1] = $foodType->getId();
      $error->setText(ApplicationErrorData::getErrorText($$errorCode, $codes));
    }
  }
}
$resp["confirmSave"] = $confirmSave;
if (!empty($error)){
  $resp["Error"] = $error;
}
echo json_encode($resp);

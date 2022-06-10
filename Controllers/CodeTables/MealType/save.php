<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/MealType/DistriXCodeTableMealTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/MealType/DistriXCodeTableMealTypeNameData.php");

$confirmSave  = false;

if (isset($_POST)) {
  list($mealType, $jsonError) = DistriXCodeTableMealTypeData::getJsonData($_POST);
  list($mealTypeNames, $jsonError) = DistriXCodeTableMealTypeNameData::getJsonArray($mealType->getNames());
  $mealType->setNames([]); // Needed to be sent without an array fulfilled with elements that are not data objects. Yvan 01 June 22

  // print_r($mealType);
  // print_r($mealTypeNames);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setDebugMode(DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE);
  // $servicesCaller->setDebugModeAllLayerOn();
  $servicesCaller->addParameter("data", $mealType);
  $servicesCaller->addParameter("dataNames", $mealTypeNames);
  $servicesCaller->setServiceName("TablesCodes/MealType/DistriXMealTypeSaveDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  echo "-*/*/*/*/*/*/*/***/*/*/*/*/-"; print_r($output); echo "-*/*/*/*/*/*/*/***/*/*/*/*/-";

  $logOk = logController("Security_MealType", "DistriXMealTypeSaveDataSvc", "SaveMealType", $output);

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
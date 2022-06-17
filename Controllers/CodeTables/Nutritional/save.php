<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalNameData.php");

$confirmSave  = false;

if (isset($_POST)) {
  list($nutritional, $jsonError) = DistriXCodeTableNutritionalData::getJsonData($_POST);
  list($nutritionalNames, $jsonError) = DistriXCodeTableNutritionalNameData::getJsonArray($nutritional->getNames());
  $nutritional->setNames([]); // Needed to be sent without an array fulfilled with elements that are not data objects. 01 June 22

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setDebugMode(DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE);
  // $servicesCaller->setDebugModeAllLayerOn();
  $servicesCaller->addParameter("data", $nutritional);
  $servicesCaller->addParameter("dataNames", $nutritionalNames);
  $servicesCaller->setServiceName("TablesCodes/Nutritional/DistriXNutritionalSaveDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  
  $logOk = logController("Security_Nutritional", "DistriXNutritionalSaveDataSvc", "SaveNutritional", $output);

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
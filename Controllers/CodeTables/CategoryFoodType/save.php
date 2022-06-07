<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/CategoryFoodType/DistriXCodeTableCategoryFoodTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/CategoryFoodType/DistriXCodeTableCategoryFoodTypeNameData.php");

$confirmSave  = false;

if (isset($_POST)) {
  list($foodType, $jsonError) = DistriXCodeTableCategoryFoodTypeData::getJsonData($_POST);
  list($foodTypeNames, $jsonError) = DistriXCodeTableCategoryFoodTypeNameData::getJsonArray($foodType->getNames());
  $foodType->setNames([]); // Needed to be sent without an array fulfilled with elements that are not data objects. Yvan 01 June 22

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $foodType);
  $servicesCaller->addParameter("dataNames", $foodTypeNames);
  $servicesCaller->setServiceName("TablesCodes/CategoryFoodType/DistriXCategoryFoodTypeSaveDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  echo "--"; print_r($output);

  $logOk = logController("Security_CategoryFoodType", "DistriXCategoryFoodTypeSaveDataSvc", "SaveCategoryFoodType", $output);

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
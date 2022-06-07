<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/Data/DistriXCodeTableCategoryFoodTypeData.php");

$confirmSave = false;

if (isset($_POST)) {
  list($foodType, $errorJson) = DistriXCodeTableCategoryFoodTypeData::getJsonData($_POST);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $foodType);
  $servicesCaller->setServiceName("TablesCodes/CategoryFoodType/DistriXCategoryFoodTypeRestoreDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

  $logOk = logController("Security_CategoryFoodType", "DistriXCategoryFoodTypeRestoreDataSvc", "RestoreCategoryFoodType", $output);

  if ($outputok && !empty($output) && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
}
$resp["confirmSave"] = $confirmSave;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
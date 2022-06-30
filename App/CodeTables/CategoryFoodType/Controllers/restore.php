<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableCategoryFoodTypeData.php");

$i18cdlangue    = 'FR';
// If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
$international  = __DIR__.'/i18/'.$i18cdlangue.'/codeTableCategoryFoodTypeList'.$i18cdlangue;
include(__DIR__ . "/../../../i18/_i18.php");
$international  = $i18cdlangue.'Global/globalTranslation';
include(__DIR__ . "/../../../i18/_i18.php");

$confirmSave = false;

if (isset($_POST)) {
  list($categoryFoodType, $errorJson) = DistriXCodeTableCategoryFoodTypeData::getJsonData($_POST);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $categoryFoodType);
  $servicesCaller->setServiceName("App/CodeTables/CategoryFoodType/Services/DistriXCategoryFoodTypeRestoreDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  // print_r($output);

  $logOk = logController("Security_CategoryFoodType", "DistriXCategoryFoodTypeRestoreDataSvc", "RestoreCategoryFoodType", $output);

  if ($outputok && !empty($output) && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    list($error, $jsonError) = ApplicationErrorData::getJsonData($errorData);
    $errorCode = "error_".$error->getCode()."_txt";
    if (isset($$errorCode)) {
      $error->setText(ApplicationErrorData::getErrorText($$errorCode, []));
    }
  }
}
$resp["ConfirmSave"] = $confirmSave;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
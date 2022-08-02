<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableMealTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableMealTypeNameData.php");

$i18cdlangue    = 'FR';
// If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
$international  = __DIR__.'/i18/'.$i18cdlangue.'/codeTableMealTypeList'.$i18cdlangue;
include(__DIR__ . "/../../../i18/_i18.php");

$confirmSave  = false;

if (isset($_POST)) {
  list($mealType, $jsonError) = DistriXCodeTableMealTypeData::getJsonData($_POST);
  list($mealTypeNames, $jsonError) = DistriXCodeTableMealTypeNameData::getJsonArray($mealType->getNames());
  $mealType->setNames([]); // Needed to be sent without an array fulfilled with elements that are not data objects. 01 June 22
  
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setDebugMode(DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE);
  // $servicesCaller->setDebugModeAllLayerOn();
  $servicesCaller->addParameter("data", $mealType);
  $servicesCaller->addParameter("dataNames", $mealTypeNames);
  $servicesCaller->setServiceName("App/CodeTables/MealType/Services/DistriXMealTypeSaveDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  // echo "-*/-"; print_r($output); echo "-*/-";

  $logOk = logController("Security_MealType", "DistriXMealTypeSaveDataSvc", "SaveMealType", $output);

  if ($outputok && !empty($output) > 0 && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    // $error = $errorData;
    list($error, $jsonError) = ApplicationErrorData::getJsonData($errorData);
    $errorCode = "error_".$error->getCode()."_txt";
    if (isset($$errorCode)) {
      $codes[0] = $mealType->getCode();
      $codes[1] = $mealType->getId();
      $error->setText(ApplicationErrorData::getErrorText($$errorCode, $codes));
    }
  }
}
$resp["ConfirmSave"] = $confirmSave;
if (!empty($error)){
  $resp["Error"] = $error;
}
echo json_encode($resp);

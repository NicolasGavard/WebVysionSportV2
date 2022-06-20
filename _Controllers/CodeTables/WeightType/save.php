<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/WeightType/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/WeightType/DistriXCodeTableWeightTypeNameData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp         = array();
$confirmSave  = false;
$error        = array();
$output       = array();
$outputok     = false;

$distriXCodeTableWeightTypeData = new DistriXCodeTableWeightTypeNameData();
$distriXCodeTableWeightTypeData->setId($_POST['id']);
$distriXCodeTableWeightTypeData->setIdWeightType($_POST['idWeightType']);
$distriXCodeTableWeightTypeData->setIdLanguage($_POST['idLanguage']);
$distriXCodeTableWeightTypeData->setCode($_POST['code']);
$distriXCodeTableWeightTypeData->setName($_POST['name']);
$distriXCodeTableWeightTypeData->setDescription($_POST['description']);
$distriXCodeTableWeightTypeData->setAbbreviation($_POST['abbreviation']);
if ($_POST['weightTypeType'] == 'isSolid') {
  $distriXCodeTableWeightTypeData->setIsSolid(1);
}
if ($_POST['weightTypeType'] == 'isLiquid') {
  $distriXCodeTableWeightTypeData->setIsLiquid(1);
}
if ($_POST['weightTypeType'] == 'isOther') {
  $distriXCodeTableWeightTypeData->setIsOther(1);
}
$distriXCodeTableWeightTypeData->setStatus($_POST['statut']);
$distriXCodeTableWeightTypeData->setTimestamp($_POST['timestamp']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveWeightType");
$servicesCaller->addParameter("data", $distriXCodeTableWeightTypeData);
$servicesCaller->setServiceName("TablesCodes/WeightType/DistriXWeightTypeSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_WeightType")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXWeightTypeSaveDataSvc");
  $logInfoData->setLogFunction("SaveWeightType");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}

if ($outputok && !empty($output) > 0) {
  if (isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  }
} else {
  $error = $errorData;
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
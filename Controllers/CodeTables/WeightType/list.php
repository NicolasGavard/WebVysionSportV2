<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeNameData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableLanguageData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

session_start();
$resp             = array();
$listLanguages    = array();
$listWeightTypes  = array();
$error            = array();
$output           = array();
$outputok         = false;

$infoProfil[0]['idLanguage'] = 1;
$_POST['id'] = $infoProfil[0]['idLanguage']; // NG 27-05-22 - until a solution is found
list($distriXCodeTableLanguageData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);

$languageCaller = new DistriXServicesCaller();
$languageCaller->setMethodName("ListLanguages");
$languageCaller->setServiceName("DistriXServices/TablesCodes/Language/DistriXLanguageListDataSvc.php");

$weightTypeCaller = new DistriXServicesCaller();
$weightTypeCaller->setMethodName("ListWeightTypes");
$weightTypeCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);
$weightTypeCaller->setServiceName("DistriXServices/TablesCodes/WeightType/DistriXWeightTypeListDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("Language", $languageCaller);
$svc->addToCall("WeightType", $weightTypeCaller);

$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("Language"); //var_dump($output);
if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
  list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("WeightType"); //var_dump($output);
if ($outputok && isset($output["ListWeightTypes"]) && is_array($output["ListWeightTypes"])) {
  list($listWeightTypes, $jsonError) = DistriXCodeTableWeightTypeData::getJsonArray($output["ListWeightTypes"]);
} else {
  $error = $errorData;
}

$resp["ListWeightTypes"]  = $listWeightTypes;
$resp["ListLanguages"]    = $listLanguages;
if(!empty($error)){
  $resp["Error"]          = $error;
}

echo json_encode($resp);
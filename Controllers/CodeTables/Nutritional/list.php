<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalNameData.php");
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");
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
$listNutritionals = array();
$error            = array();
$output           = array();
$outputok         = false;

$infoProfil = DistriXStyAppInterface::getUserInformation();
$_POST['id'] = $infoProfil->getIdLanguage(); // NG 27-05-22 - until a solution is found
list($distriXCodeTableLanguageData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);

$languageCaller = new DistriXServicesCaller();
$languageCaller->setMethodName("ListLanguages");
$languageCaller->setServiceName("TablesCodes/Language/DistriXLanguageListDataSvc.php");

$weightTypeCaller = new DistriXServicesCaller();
$weightTypeCaller->setMethodName("ListNutritionals");
$weightTypeCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);
$weightTypeCaller->setServiceName("TablesCodes/Nutritional/DistriXNutritionalListDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("Language", $languageCaller);
$svc->addToCall("Nutritional", $weightTypeCaller);

$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("Language"); //var_dump($output);
if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
  list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("Nutritional"); //var_dump($output);
if ($outputok && isset($output["ListNutritionals"]) && is_array($output["ListNutritionals"])) {
  list($listNutritionals, $jsonError) = DistriXCodeTableNutritionalData::getJsonArray($output["ListNutritionals"]);
} else {
  $error = $errorData;
}



$resp["ListNutritionals"]  = $listNutritionals;
$resp["ListLanguages"]    = $listLanguages;
if(!empty($error)){
  $resp["Error"]          = $error;
}

echo json_encode($resp);
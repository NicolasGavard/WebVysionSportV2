<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");

$listLanguages    = array();
$listNutritionals = array();

$infoProfil = DistriXStyAppInterface::getUserInformation();
$_POST['id'] = $infoProfil->getIdLanguage();
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
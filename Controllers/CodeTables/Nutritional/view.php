<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");

$infoProfil = DistriXStyAppInterface::getUserInformation();
$_POST['id'] = $infoProfil->getIdLanguage();
list($distriXCodeTableLanguageData, $errorJson)     = DistriXCodeTableLanguageData::getJsonData($_POST);
list($distriXCodeTableNutritionalData, $errorJson)  = DistriXCodeTableNutritionalData::getJsonData($_POST);

$languageCaller = new DistriXServicesCaller();
$languageCaller->setServiceName("TablesCodes/Language/DistriXLanguageListDataSvc.php");

$nutritionalCaller = new DistriXServicesCaller();
$nutritionalCaller->addParameter("data", $distriXCodeTableNutritionalData);
$nutritionalCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);
$nutritionalCaller->setServiceName("TablesCodes/Nutritional/DistriXNutritionalViewDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("Language", $languageCaller);
$svc->addToCall("Nutritional", $nutritionalCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("Language"); //var_dump($output);
if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
  list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("Nutritional"); var_dump($output);
if ($outputok && isset($output["ViewNutritional"]) && is_array($output["ViewNutritional"])) {
  list($nutritional, $jsonError) = DistriXCodeTableNutritionalData::getJsonData($output["ViewNutritional"]);
} else {
  $error = $errorData;
}

$resp["ViewNutritional"]  = $nutritional;
$resp["ListLanguages"]    = $listLanguages;
if(!empty($error)){
  $resp["Error"]         = $error;
}

echo json_encode($resp);
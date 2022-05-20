<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyLanguageData.php");

$resp = [];

$distriXStyLanguageData = new DistriXStyLanguageData();
$distriXStyLanguageData->setId($_POST['id']);
list($confirmSave, $errorData) = DistriXStyLanguage::delLanguage($distriXStyLanguageData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
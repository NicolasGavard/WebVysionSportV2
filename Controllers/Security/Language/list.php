<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyLanguageData.php");

$resp                   = [];
$ListLanguages          = DistriXStyLanguage::listLanguages();
$resp["ListLanguages"]  = $ListLanguages;

echo json_encode($resp);
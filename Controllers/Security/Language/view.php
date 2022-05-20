<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyLanguageData.php");

$resp                 = [];
$viewLanguage         = new DistriXStyLanguageData();

if(!empty($_POST['id'])){
  $viewLanguage       = DistriXStyLanguage::viewLanguage($_POST['id']);
}

$resp["ViewLanguage"] = $viewLanguage;

echo json_encode($resp);
<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppEnterprise.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppLanguage.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyEnterpriseData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyLanguageData.php");

$resp               = [];
$viewUser           = new DistriXStyUserData();
$listEnterprises    = [];
$listLanguages      = [];

if(!empty($_POST['id'])){
  $viewUser         = DistriXStyUAppser::viewUser($_POST['id']);
  $listEnterprises  = DistriXStyAppEnterprise::listEnterprises();
  $listLanguages    = DistriXStyAppLanguage::listLanguages();
}

$resp["ViewUser"]         = $viewUser;
$resp["ListEnterprises"]  = $listEnterprises;
$resp["ListLanguages"]    = $listLanguages;

echo json_encode($resp);
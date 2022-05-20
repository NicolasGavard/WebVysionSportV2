<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyEnterprise.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
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
  $viewUser         = DistriXStyUser::viewUser($_POST['id']);
  $listEnterprises  = DistriXStyEnterprise::listEnterprises();
  $listLanguages    = DistriXStyLanguage::listLanguages();
}

$resp["ViewUser"]         = $viewUser;
$resp["ListEnterprises"]  = $listEnterprises;
$resp["ListLanguages"]    = $listLanguages;

echo json_encode($resp);
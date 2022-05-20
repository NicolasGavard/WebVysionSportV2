<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyLanguageData.php");

$resp                   = [];
$_POST['id']            = 1;
$idUser                 = $_POST['id'];
$listUsers              = DistriXStyUser::viewUser($idUser);
$listLanguages          = DistriXStyLanguage::listLanguages();
$resp["InfoUser"]       = $listUsers;
$resp["ListLanguages"]  = $listLanguages;

echo json_encode($resp);
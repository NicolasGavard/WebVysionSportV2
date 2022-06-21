<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyEnterprise.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyEnterpriseData.php");

$resp = [];

$distriXStyUserData = new DistriXStyUserData();
$distriXStyUserData->setId($_POST['id']);
$distriXStyUserData->setLogin($_POST['login']);
$distriXStyUserData->setFirstName($_POST['firstName']);
$distriXStyUserData->setName($_POST['name']);
$distriXStyUserData->setLinkToPicture('');
$distriXStyUserData->setPass($_POST['pass']);
$distriXStyUserData->setEmail($_POST['email']);
$distriXStyUserData->setEmailBackup($_POST['emailBackup']);
$distriXStyUserData->setPhone($_POST['phone']);
$distriXStyUserData->setMobile($_POST['mobile']);
$distriXStyUserData->setInitPass($_POST['initPass']);
$distriXStyUserData->setIdLanguage($_POST['idLanguage']);
$distriXStyUserData->setIdStyEnterprise($_POST['idStyEnterprise']);
$distriXStyUserData->setStatus($_POST['statut']);
list($confirmSave, $errorData) = DistriXStyAppUser::saveUser($distriXStyUserData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
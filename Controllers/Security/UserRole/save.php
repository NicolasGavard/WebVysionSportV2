<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyEnterprise.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyEnterpriseData.php");

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
list($confirmSave, $errorData) = DistriXStyUser::saveUser($distriXStyUserData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
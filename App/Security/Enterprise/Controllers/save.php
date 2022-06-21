<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppEnterprise.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyEnterpriseData.php");

$resp = [];

$distriXStyEnterpriseData = new DistriXStyEnterpriseData();
$distriXStyEnterpriseData->setIdUser($_POST['idUser']);
$distriXStyEnterpriseData->setLogin($_POST['login']);
$distriXStyEnterpriseData->setFirstName($_POST['firstName']);
$distriXStyEnterpriseData->setName($_POST['name']);
$distriXStyEnterpriseData->setLinkToPicture('');
$distriXStyEnterpriseData->setPass($_POST['pass']);
$distriXStyEnterpriseData->setEmail($_POST['email']);
$distriXStyEnterpriseData->setEmailBackup($_POST['emailBackup']);
$distriXStyEnterpriseData->setPhone($_POST['phone']);
$distriXStyEnterpriseData->setMobile($_POST['mobile']);
$distriXStyEnterpriseData->setInitPass($_POST['initPass']);
$distriXStyEnterpriseData->setIdLanguage($_POST['idLanguage']);
$distriXStyEnterpriseData->setIdStyEnterprise($_POST['idStyEnterprise']);
$distriXStyEnterpriseData->setStatus($_POST['statut']);
list($confirmSave, $errorData) = DistriXStyAppEnterprise::saveUser($distriXStyEnterpriseData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
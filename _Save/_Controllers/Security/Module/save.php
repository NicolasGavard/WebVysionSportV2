<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppModule.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyModuleData.php");

$resp = [];

$distriXStyModuleData = new DistriXStyModuleData();
$distriXStyModuleData->setId($_POST['id']);
$distriXStyModuleData->setIdStyApplication($_POST['idStyApplication']);
$distriXStyModuleData->setCode($_POST['code']);
$distriXStyModuleData->setDescription($_POST['description']);
$distriXStyModuleData->setStatus($_POST['status']);
$distriXStyModuleData->setTimestamp($_POST['timestamp']);
list($confirmSave, $errorData) = DistriXStyAppModule::saveModule($distriXStyModuleData);

$resp["ConfirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
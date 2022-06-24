<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppModule.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyModuleData.php");

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
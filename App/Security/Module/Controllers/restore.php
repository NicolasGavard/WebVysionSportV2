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
list($confirmSave, $errorData) = DistriXStyAppModule::restoreModule($distriXStyModuleData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
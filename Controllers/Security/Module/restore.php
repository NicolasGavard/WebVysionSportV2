<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyModule.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyModuleData.php");

$resp = [];

$distriXStyModuleData = new DistriXStyModuleData();
$distriXStyModuleData->setId($_POST['id']);
list($confirmSave, $errorData) = DistriXStyModule::restoreModule($distriXStyModuleData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppFunctionality.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyFunctionalityData.php");

$resp = [];

$distriXStyFunctionalityData = new DistriXStyFunctionalityData();
$distriXStyFunctionalityData->setId($_POST['id']);
list($confirmSave, $errorData) = DistriXStyAppFunctionality::delFunctionality($distriXStyFunctionalityData);

$resp["ConfirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
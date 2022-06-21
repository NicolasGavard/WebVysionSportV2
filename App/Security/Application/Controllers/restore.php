<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppApplication.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyApplicationData.php");

$resp = [];

$distriXStyApplicationData = new DistriXStyApplicationData();
$distriXStyApplicationData->setId($_POST['id']);
list($confirmSave, $errorData) = DistriXStyAppApplication::restoreApplication($distriXStyApplicationData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
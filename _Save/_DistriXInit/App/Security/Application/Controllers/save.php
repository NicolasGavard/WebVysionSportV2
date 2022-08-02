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
$distriXStyApplicationData->setCode($_POST['code']);
$distriXStyApplicationData->setDescription($_POST['description']);
$distriXStyApplicationData->setStatus($_POST['status']);
$distriXStyApplicationData->setTimestamp($_POST['timestamp']);
list($confirmSave, $errorData) = DistriXStyAppApplication::saveApplication($distriXStyApplicationData);

$resp["ConfirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
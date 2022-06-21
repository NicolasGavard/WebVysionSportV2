<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppRole.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyRoleData.php");

$resp = [];

$distriXStyRoleData = new DistriXStyRoleData();
$distriXStyRoleData->setId($_POST['id']);
$distriXStyRoleData->setCode($_POST['code']);
$distriXStyRoleData->setName($_POST['name']);
$distriXStyRoleData->setDescription($_POST['description']);
$distriXStyRoleData->setStatus($_POST['statut']);
$distriXStyRoleData->setTimestamp($_POST['timestamp']);
list($confirmSave, $errorData) = DistriXStyAppRole::saveRole($distriXStyRoleData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
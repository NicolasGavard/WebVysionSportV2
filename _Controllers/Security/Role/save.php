<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRole.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleData.php");

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
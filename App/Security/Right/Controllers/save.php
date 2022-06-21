<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRight.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRightData.php");

$resp = [];

$distriXStyRightData = new DistriXStyRightData();
$distriXStyRightData->setId($_POST['id']);
$distriXStyRightData->setCode($_POST['code']);
$distriXStyRightData->setName($_POST['name']);
$distriXStyRightData->setDescription($_POST['description']);
$distriXStyRightData->setStatus($_POST['statut']);
$distriXStyRightData->setTimestamp($_POST['timestamp']);
list($confirmSave, $errorData) = DistriXStyAppRight::saveRight($distriXStyRightData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
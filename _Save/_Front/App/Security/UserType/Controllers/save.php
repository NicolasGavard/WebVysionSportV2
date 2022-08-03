<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppUserType.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyUserTypeData.php");

include(__DIR__ . "../../../GlobalData/ApplicationErrorData.php");
include(__DIR__ . "../../../GlobalData/ApplicationLayerData.php");

$resp = [];

$distriXStyUserTypeData = new DistriXStyUserTypeData();
$distriXStyUserTypeData->setId($_POST['id']);
$distriXStyUserTypeData->setCode($_POST['code']);
$distriXStyUserTypeData->setName($_POST['name']);
$distriXStyUserTypeData->setStatus($_POST['statut']);
$distriXStyUserTypeData->setTimestamp($_POST['timestamp']);
list($confirmSave, $errorData) = DistriXStyAppUserType::saveUserType($distriXStyUserTypeData);

$resp["ConfirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
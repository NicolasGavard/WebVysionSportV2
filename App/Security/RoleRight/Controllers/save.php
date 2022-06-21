<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppRoleRight.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyRoleRightData.php");

$resp = [];

$distriStyRoleRightData = new DistriXStyRoleRightData();
$distriStyRoleRightData->setIdStyRole($_POST['idStyRole']);
$distriStyRoleRightData->setIdStyApplication($_POST['idStyApplication']);
$distriStyRoleRightData->setIdStyModule($_POST['idStyModule']);
$distriStyRoleRightData->setIdStyFunctionality($_POST['idStyFunctionality']);
$distriStyRoleRightData->setSumOfRights($_POST['sumOfRights']);
list($confirmSave, $errorData) = DistriXStyAppRoleRight::saveRoleRight($distriStyRoleRightData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
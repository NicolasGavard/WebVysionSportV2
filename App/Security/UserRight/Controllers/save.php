<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppUserRight.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyUserRightData.php");

$resp = [];

$distriStyUserRightData = new DistriXStyUserRightData();
$distriStyUserRightData->setIdStyUser($_POST['idStyUser']);
$distriStyUserRightData->setIdStyApplication($_POST['idStyApplication']);
$distriStyUserRightData->setIdStyModule($_POST['idStyModule']);
$distriStyUserRightData->setIdStyFunctionality($_POST['idStyFunctionality']);
$distriStyUserRightData->setSumOfRights($_POST['sumOfRights']);
list($confirmSave, $errorData) = DistriXStyAppUserRight::saveUserRight($distriStyUserRightData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
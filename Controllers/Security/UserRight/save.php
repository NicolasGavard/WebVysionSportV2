<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUserRight.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserRightData.php");

$resp = [];

$distriStyUserRightData = new DistriXStyUserRightData();
$distriStyUserRightData->setIdStyUser($_POST['idStyUser']);
$distriStyUserRightData->setIdStyApplication($_POST['idStyApplication']);
$distriStyUserRightData->setIdStyModule($_POST['idStyModule']);
$distriStyUserRightData->setIdStyFunctionality($_POST['idStyFunctionality']);
$distriStyUserRightData->setSumOfRights($_POST['sumOfRights']);
list($confirmSave, $errorData) = DistriXStyUserRight::saveUserRight($distriStyUserRightData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
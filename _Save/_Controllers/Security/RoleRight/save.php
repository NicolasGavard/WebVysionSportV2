<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRoleRight.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleRightData.php");

$resp = [];

$distriStyRoleRightData = new DistriXStyRoleRightData();
$distriStyRoleRightData->setIdStyRole($_POST['idStyRole']);
$distriStyRoleRightData->setIdStyApplication($_POST['idStyApplication']);
$distriStyRoleRightData->setIdStyModule($_POST['idStyModule']);
$distriStyRoleRightData->setIdStyFunctionality($_POST['idStyFunctionality']);
$distriStyRoleRightData->setSumOfRights($_POST['sumOfRights']);
list($confirmSave, $errorData) = DistriXStyAppRoleRight::saveRoleRight($distriStyRoleRightData);

$resp["ConfirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUserType.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserTypeData.php");

include(__DIR__ . "../../../GlobalData/ApplicationErrorData.php");
include(__DIR__ . "../../../GlobalData/ApplicationLayerData.php");

$resp = [];

$distriXStyUserTypeData = new DistriXStyUserTypeData();
$distriXStyUserTypeData->setId($_POST['id']);
$distriXStyUserTypeData->setCode($_POST['code']);
$distriXStyUserTypeData->setName($_POST['name']);
$distriXStyUserTypeData->setStatus($_POST['statut']);
$distriXStyUserTypeData->setTimestamp($_POST['timestamp']);
list($confirmSave, $errorData) = DistriXStyUserType::saveUserType($distriXStyUserTypeData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
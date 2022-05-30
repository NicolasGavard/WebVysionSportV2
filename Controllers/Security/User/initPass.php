<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyEnterprise.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyEnterpriseData.php");

$resp = [];

$distriXStyUserData = new DistriXStyUserData();
$distriXStyUserData->setId($_POST['id']);
list($confirmSave, $errorData) = DistriXStyAppUser::delUser($distriXStyUserData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
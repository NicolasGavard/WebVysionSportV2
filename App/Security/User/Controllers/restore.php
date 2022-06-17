<?php
session_start();
include(__DIR__ . "/../../../Controllers/Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");

$resp = [];

$distriXStyUserData = new DistriXStyUserData();
$distriXStyUserData->setId($_POST['id']);
list($confirmSave, $errorData) = DistriXStyAppUser::restoreUser($distriXStyUserData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
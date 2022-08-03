<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppApplication.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyApplicationData.php");

$resp = [];

$distriXStyApplicationData = new DistriXStyApplicationData();
$distriXStyApplicationData->setId($_POST['id']);
list($confirmSave, $errorData) = DistriXStyAppApplication::restoreApplication($distriXStyApplicationData);

$resp["ConfirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyApplication.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyApplicationData.php");

$resp = [];

$distriXStyApplicationData = new DistriXStyApplicationData();
$distriXStyApplicationData->setId($_POST['id']);
list($confirmSave, $errorData) = DistriXStyApplication::restoreApplication($distriXStyApplicationData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
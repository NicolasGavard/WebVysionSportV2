<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppFunctionality.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyFunctionalityData.php");

$resp = [];

$distriXStyFunctionalityData = new DistriXStyFunctionalityData();
$distriXStyFunctionalityData->setId($_POST['id']);
$distriXStyFunctionalityData->setIdStyModule($_POST['idStyModule']);
$distriXStyFunctionalityData->setCode($_POST['code']);
$distriXStyFunctionalityData->setDescription($_POST['description']);
$distriXStyFunctionalityData->setStatus($_POST['status']);
$distriXStyFunctionalityData->setTimestamp($_POST['timestamp']);
list($confirmSave, $errorData) = DistriXStyAppFunctionality::saveFunctionality($distriXStyFunctionalityData);

$resp["ConfirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
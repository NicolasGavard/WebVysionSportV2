<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyFunctionality.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyFunctionalityData.php");

$resp = [];

$distriXStyFunctionalityData = new DistriXStyFunctionalityData();
$distriXStyFunctionalityData->setId($_POST['id']);
$distriXStyFunctionalityData->setIdStyModule($_POST['idStyModule']);
$distriXStyFunctionalityData->setCode($_POST['code']);
$distriXStyFunctionalityData->setDescription($_POST['description']);
$distriXStyFunctionalityData->setStatus($_POST['status']);
$distriXStyFunctionalityData->setTimestamp($_POST['timestamp']);
list($confirmSave, $errorData) = DistriXStyFunctionality::saveFunctionality($distriXStyFunctionalityData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
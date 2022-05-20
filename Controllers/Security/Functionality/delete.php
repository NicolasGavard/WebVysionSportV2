<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyFunctionality.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyFunctionalityData.php");

$resp = [];

$distriXStyFunctionalityData = new DistriXStyFunctionalityData();
$distriXStyFunctionalityData->setId($_POST['id']);
list($confirmSave, $errorData) = DistriXStyFunctionality::delFunctionality($distriXStyFunctionalityData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
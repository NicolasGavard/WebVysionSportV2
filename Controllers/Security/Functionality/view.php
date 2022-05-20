<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyFunctionality.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyFunctionalityData.php");

$resp                       = [];
$idFunctionality            = $_POST['id'];
$functionality              = DistriXStyFunctionality::viewFunctionality($idFunctionality);
$resp["ViewFunctionality"]  = $functionality;

echo json_encode($resp);
<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppFunctionality.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyFunctionalityData.php");

$resp                       = [];
$idFunctionality            = $_POST['id'];
$functionality              = DistriXStyAppFunctionality::viewFunctionality($idFunctionality);
$resp["ViewFunctionality"]  = $functionality;

echo json_encode($resp);
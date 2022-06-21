<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppApplication.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyApplicationData.php");

$resp                     = [];
$idApplication            = $_POST['id'];
$application              = DistriXStyAppApplication::viewApplication($idApplication);
$resp["ViewApplication"]  = $application;

echo json_encode($resp);
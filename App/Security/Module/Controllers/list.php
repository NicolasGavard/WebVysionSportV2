<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppModule.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppApplication.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyModuleData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyApplicationData.php");

$resp             = [];

$idStyApplication = 0;

if (isset($_POST['idStyApplication']) && $_POST['idStyApplication'] > 0) {$idStyApplication = $_POST['idStyApplication'];}

$ListModules        = DistriXStyAppModule::listModules($idStyApplication);
$resp["ListModules"]= $ListModules;

$ListApplications        = DistriXStyAppApplication::listApplications();
$resp["ListApplications"]= $ListApplications;

echo json_encode($resp);
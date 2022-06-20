<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppModule.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppApplication.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyModuleData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyApplicationData.php");

$resp             = [];

$idStyApplication = 0;

if (isset($_POST['idStyApplication']) && $_POST['idStyApplication'] > 0) {$idStyApplication = $_POST['idStyApplication'];}

$ListModules        = DistriXStyAppModule::listModules($idStyApplication);
$resp["ListModules"]= $ListModules;

$ListApplications        = DistriXStyAppApplication::listApplications();
$resp["ListApplications"]= $ListApplications;

echo json_encode($resp);
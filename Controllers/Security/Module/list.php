<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyModule.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyApplication.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyModuleData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyApplicationData.php");

$resp             = [];

$idStyApplication = 0;

if (isset($_POST['idStyApplication']) && $_POST['idStyApplication'] > 0) {$idStyApplication = $_POST['idStyApplication'];}

$ListModules        = DistriXStyModule::listModules($idStyApplication);
$resp["ListModules"]= $ListModules;

$ListApplications        = DistriXStyApplication::listApplications();
$resp["ListApplications"]= $ListApplications;

echo json_encode($resp);
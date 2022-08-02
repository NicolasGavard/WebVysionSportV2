<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppApplication.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppModule.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppFunctionality.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyApplicationData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyModuleData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyFunctionalityData.php");

$resp             = [];
$idStyApplication = 0;
$idStyModule      = 0;

if (isset($_POST['idStyApplication']) && $_POST['idStyApplication'] > 0)  { $idStyApplication  = $_POST['idStyApplication']; $idStyModule = 0;}
if (isset($_POST['idStyModule'])      && $_POST['idStyModule'] > 0)       { $idStyModule       = $_POST['idStyModule']; }

$resp["ListApplications"]     = DistriXStyAppApplication::listApplications();
if($idStyApplication > 0){
  $resp["ListModules"]        = DistriXStyAppModule::listModules($idStyApplication);
}
$resp["ListFunctionalities"]  = DistriXStyAppFunctionality::listFunctionalities($idStyApplication, $idStyModule);

echo json_encode($resp);
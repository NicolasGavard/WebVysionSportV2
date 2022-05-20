<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyApplication.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyModule.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyFunctionality.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyModuleData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyFunctionalityData.php");

$resp             = [];
$idStyApplication = 0;
$idStyModule      = 0;

if (isset($_POST['idStyApplication']) && $_POST['idStyApplication'] > 0)  { $idStyApplication  = $_POST['idStyApplication']; $idStyModule = 0;}
if (isset($_POST['idStyModule'])      && $_POST['idStyModule'] > 0)       { $idStyModule       = $_POST['idStyModule']; }

$resp["ListApplications"]     = DistriXStyApplication::listApplications();
if($idStyApplication > 0){
  $resp["ListModules"]        = DistriXStyModule::listModules($idStyApplication);
}
$resp["ListFunctionalities"]  = DistriXStyFunctionality::listFunctionalities($idStyApplication, $idStyModule);

echo json_encode($resp);
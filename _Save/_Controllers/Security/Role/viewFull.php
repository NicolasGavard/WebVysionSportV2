<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppApplication.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppModule.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRight.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRole.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRoleRight.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppFunctionality.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyModuleData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRightData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleRightData.php");  
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyFunctionalityData.php");

// $_POST['idRole']              = 1;
// $_POST['idStyApplication']    = 1;
// $_POST['idStyModule']         = 1;
// $_POST['idStyFunctionality']  = 0;

$resp             = [];
$resp["ViewRole"] = DistriXStyRole::viewRole($_POST['idRole']);

// Applications list
$resp["ListApplications"] = DistriXStyAppApplication::listApplications();

if(isset($_POST['idStyApplication']) && $_POST['idStyApplication'] > 0){
  // Modules list
  $idStyApplication     = "";
  if (isset($_POST['idStyApplication']) && $_POST['idStyApplication'] > 0) {$idStyApplication = $_POST['idStyApplication'];}
  $resp["ListModules"]  = DistriXStyAppModule::listModules($idStyApplication); 
}

// Functionalities list
if(isset($_POST['idStyModule']) && $_POST['idStyModule'] > 0){
  $idStyModule                  = "";
  if (isset($_POST['idStyModule']) && $_POST['idStyModule'] > 0) {$idStyModule = $_POST['idStyModule'];}
  $resp["ListFunctionalities"]  = DistriXStyAppFunctionality::listFunctionalities($idStyApplication, $idStyModule);
}

// Rights list
$resp["ListRights"] = DistriXStyAppRight::listRights();

// Applications, Modules, Functionalities list for this Role
$distriXStyRoleRightData = new DistriXStyRoleRightData();
$distriXStyRoleRightData->setIdStyRole($_POST['idRole']);
$distriXStyRoleRightData->setIdStyApplication($_POST['idStyApplication']);
$distriXStyRoleRightData->setIdStyModule($_POST['idStyModule']);
$distriXStyRoleRightData->setIdStyFunctionality($_POST['idStyFunctionality']);
$resp["ListModulesByRole"]    = DistriXStyAppRoleRight::roleRightByRole($distriXStyRoleRightData);

echo json_encode($resp);
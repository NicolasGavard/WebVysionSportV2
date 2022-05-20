<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyApplication.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyModule.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyRight.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyRole.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyRoleRight.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyFunctionality.php");
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
$resp["ListApplications"] = DistriXStyApplication::listApplications();

if(isset($_POST['idStyApplication']) && $_POST['idStyApplication'] > 0){
  // Modules list
  $idStyApplication     = "";
  if (isset($_POST['idStyApplication']) && $_POST['idStyApplication'] > 0) {$idStyApplication = $_POST['idStyApplication'];}
  $resp["ListModules"]  = DistriXStyModule::listModules($idStyApplication); 
}

// Functionalities list
if(isset($_POST['idStyModule']) && $_POST['idStyModule'] > 0){
  $idStyModule                  = "";
  if (isset($_POST['idStyModule']) && $_POST['idStyModule'] > 0) {$idStyModule = $_POST['idStyModule'];}
  $resp["ListFunctionalities"]  = DistriXStyFunctionality::listFunctionalities($idStyApplication, $idStyModule);
}

// Rights list
$resp["ListRights"] = DistriXStyRight::listRights();

// Applications, Modules, Functionalities list for this Role
$distriXStyRoleRightData = new DistriXStyRoleRightData();
$distriXStyRoleRightData->setIdStyRole($_POST['idRole']);
$distriXStyRoleRightData->setIdStyApplication($_POST['idStyApplication']);
$distriXStyRoleRightData->setIdStyModule($_POST['idStyModule']);
$distriXStyRoleRightData->setIdStyFunctionality($_POST['idStyFunctionality']);
$resp["ListModulesByRole"]    = DistriXStyRoleRight::roleRightByRole($distriXStyRoleRightData);

echo json_encode($resp);
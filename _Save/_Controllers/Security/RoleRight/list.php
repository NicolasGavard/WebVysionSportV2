<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRoleRight.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleRightData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleRightsData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyModuleData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyFunctionalityData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRightData.php");

$resp                   = [];
$distriXStyRoleRightData =  new DistriXStyRoleRightData();
$distriXStyRoleRightData->setIdStyRole($_POST['idStyRole']);

$ListRolesRights        = DistriXStyAppRoleRight::roleRightByRole($distriXStyRoleRightData);
$resp["ListRolesRights"]= $ListRolesRights;

echo json_encode($resp);
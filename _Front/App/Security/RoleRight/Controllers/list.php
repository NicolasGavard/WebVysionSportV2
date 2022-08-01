<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppRoleRight.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyRoleRightData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyRoleRightsData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyApplicationData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyModuleData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyFunctionalityData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyRoleData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyRightData.php");

$resp                   = [];
$distriXStyRoleRightData =  new DistriXStyRoleRightData();
$distriXStyRoleRightData->setIdStyRole($_POST['idStyRole']);

$ListRolesRights        = DistriXStyAppRoleRight::roleRightByRole($distriXStyRoleRightData);
$resp["ListRolesRights"]= $ListRolesRights;

echo json_encode($resp);
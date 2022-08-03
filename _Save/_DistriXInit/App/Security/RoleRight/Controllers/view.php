<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppRoleRight.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyRoleRightData.php");  

$resp                     = [];
$distriXStyRoleRightData  = new DistriXStyRoleRightData();
$distriXStyRoleRightData->setIdStyRole($_POST['idRole']);
$resp["ListRoleRight"]    = DistriXStyAppRoleRight::roleRightByRole($distriXStyRoleRightData);

echo json_encode($resp);
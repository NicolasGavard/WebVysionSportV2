<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppRole.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyRoleData.php");

$resp             = [];
$ListRoles        = DistriXStyAppRole::listRoles();
$resp["ListRoles"]= $ListRoles;

echo json_encode($resp);
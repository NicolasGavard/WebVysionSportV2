<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppUserRole.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppRole.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyUserRoleData.php");

$resp                 = [];
$idUser               = $_POST['idUser'];
$userRole             = DistriXStyAppUserRole::viewUserRole($idUser);
$resp["ViewUserRole"] = $userRole;

$ListRoles            = DistriXStyAppRole::listRoles();
$resp["ListRoles"]    = $ListRoles;

echo json_encode($resp);
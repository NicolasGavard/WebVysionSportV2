<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUserRole.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRole.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserRoleData.php");

$resp                 = [];
$idUser               = $_POST['idUser'];
$userRole             = DistriXStyAppUserRole::viewUserRole($idUser);
$resp["ViewUserRole"] = $userRole;

$ListRoles            = DistriXStyAppRole::listRoles();
$resp["ListRoles"]    = $ListRoles;

echo json_encode($resp);
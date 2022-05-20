<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUserRole.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyRole.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserRoleData.php");

$resp                 = [];
$idUser               = $_POST['idUser'];
$userRole             = DistriXStyUserRole::viewUserRole($idUser);
$resp["ViewUserRole"] = $userRole;

$ListRoles            = DistriXStyRole::listRoles();
$resp["ListRoles"]    = $ListRoles;

echo json_encode($resp);
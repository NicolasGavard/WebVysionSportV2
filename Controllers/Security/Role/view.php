<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRole.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleData.php");

$resp               = [];
$role               = DistriXStyAppRole::viewRole($_POST['idRole']);
$resp["ViewRole"]  = $role;

echo json_encode($resp);
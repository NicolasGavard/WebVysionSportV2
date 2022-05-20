<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyRole.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleData.php");

$resp               = [];
$role               = DistriXStyRole::viewRole($_POST['idRole']);
$resp["ViewRole"]  = $role;

echo json_encode($resp);
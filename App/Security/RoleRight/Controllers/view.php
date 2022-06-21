<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRoleRight.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleRightData.php");  

$resp                     = [];
$distriXStyRoleRightData  = new DistriXStyRoleRightData();
$distriXStyRoleRightData->setIdStyRole($_POST['idRole']);
$resp["ListRoleRight"]    = DistriXStyAppRoleRight::roleRightByRole($distriXStyRoleRightData);

echo json_encode($resp);
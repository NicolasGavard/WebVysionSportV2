<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyRoleRight.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleRightData.php");  

$resp                     = [];
$distriXStyRoleRightData  = new DistriXStyRoleRightData();
$distriXStyRoleRightData->setIdStyRole($_POST['idRole']);
$resp["ListRoleRight"]    = DistriXStyRoleRight::roleRightByRole($distriXStyRoleRightData);

echo json_encode($resp);
<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUserRight.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserRightData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserRightsData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyModuleData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyFunctionalityData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRightData.php");

$resp                     = [];
$_POST['idStyUser']       = 1;

$ListUsersRights        = DistriXStyUserRight::viewUserRight($_POST['idStyUser'], '', '', '', '');
$resp["ListUsersRights"]= $ListUsersRights;

echo json_encode($resp);
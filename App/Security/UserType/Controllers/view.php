<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppUserType.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyUserTypeData.php");

$resp                 = [];
$idUserType           = 1;
$userType             = DistriXStyAppUserType::viewUserType($idUserType);
$resp["ViewUserType"] = $userType;

echo json_encode($resp);
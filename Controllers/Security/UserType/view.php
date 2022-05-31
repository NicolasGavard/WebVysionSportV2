<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUserType.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserTypeData.php");

$resp                 = [];
$idUserType           = 1;
$userType             = DistriXStyAppUserType::viewUserType($idUserType);
$resp["ViewUserType"] = $userType;

echo json_encode($resp);
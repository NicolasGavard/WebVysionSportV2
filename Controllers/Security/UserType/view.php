<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUserType.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserTypeData.php");

$resp                 = [];
$idUserType           = 1;
$userType             = DistriXStyUserType::viewUserType($idUserType);
$resp["ViewUserType"] = $userType;

echo json_encode($resp);
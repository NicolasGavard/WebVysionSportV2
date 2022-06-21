<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUserType.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserTypeData.php");

$resp                 = [];
$ListUserTypes        = DistriXStyAppUserType::listUserTypes();
$resp["ListUserTypes"]= $ListUserTypes;

echo json_encode($resp);
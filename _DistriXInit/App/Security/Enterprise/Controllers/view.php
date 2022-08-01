<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppEnterprise.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyEnterpriseData.php");

$resp                   = [];
$idStyEnterprise           = 1;
$enterprise             = DistriXStyAppEnterprise::viewEnterprise($idStyEnterprise);
$resp["ViewEnterprise"] = $enterprise;

echo json_encode($resp);
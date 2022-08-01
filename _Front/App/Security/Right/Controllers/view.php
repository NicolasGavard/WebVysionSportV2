<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppRight.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyRightData.php");

$resp               = [];
$idRight            = 1;
$rights             = DistriXStyAppRight::viewRight($idRight);
$resp["ViewRight"] = $rights;

echo json_encode($resp);
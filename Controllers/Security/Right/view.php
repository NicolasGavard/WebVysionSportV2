<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRight.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRightData.php");

$resp               = [];
$idRight            = 1;
$rights             = DistriXStyAppRight::viewRight($idRight);
$resp["ViewRight"] = $rights;

echo json_encode($resp);
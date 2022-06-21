<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppRight.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRightData.php");

$resp             = [];
$ListRights        = DistriXStyAppRight::listRights();
$resp["ListRights"]= $ListRights;

echo json_encode($resp);
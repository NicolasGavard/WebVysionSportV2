<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyRight.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRightData.php");

$resp             = [];
$ListRights        = DistriXStyRight::listRights();
$resp["ListRights"]= $ListRights;

echo json_encode($resp);
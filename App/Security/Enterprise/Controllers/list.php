<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppEnterprise.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyEnterpriseData.php");

$resp                   = [];
$ListEnterprises        = DistriXStyAppEnterprise::listEnterprises();
$resp["ListEnterprises"]= $ListEnterprises;

echo json_encode($resp);
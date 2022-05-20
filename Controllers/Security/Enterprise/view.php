<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyEnterprise.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyEnterpriseData.php");

$resp                   = [];
$idStyEnterprise           = 1;
$enterprise             = DistriXStyEnterprise::viewEnterprise($idStyEnterprise);
$resp["ViewEnterprise"] = $enterprise;

echo json_encode($resp);
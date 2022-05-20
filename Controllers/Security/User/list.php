<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyEnterprise.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyEnterpriseData.php");

$resp         = [];
$idStyEnterprise = 0;

if (isset($_POST['idStyEnterprise']) && $_POST['idStyEnterprise'] > 0) {$idStyEnterprise = $_POST['idStyEnterprise'];}

$ListUsers        = DistriXStyUser::listUsers($idStyEnterprise);
$resp["ListUsers"]  = $ListUsers;

$ListEnterprises  = DistriXStyEnterprise::listEnterprises();
$resp["ListEnterprises"]  = $ListEnterprises;

echo json_encode($resp);
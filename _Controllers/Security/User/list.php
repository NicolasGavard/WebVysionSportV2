<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppEnterprise.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyEnterpriseData.php");

$resp             = [];
$idStyEnterprise  = 1;

if (isset($_POST['idStyEnterprise']) && $_POST['idStyEnterprise'] > 0) {$idStyEnterprise = $_POST['idStyEnterprise'];}

$ListUsers        = DistriXStyAppUser::listUsers($idStyEnterprise);
$resp["ListUsers"]  = $ListUsers;

$ListEnterprises  = DistriXStyAppEnterprise::listEnterprises();
$resp["ListEnterprises"]  = $ListEnterprises;

echo json_encode($resp);
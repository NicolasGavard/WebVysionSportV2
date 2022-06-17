<?php
session_start();
include(__DIR__ . "/../../../Controllers/Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppEnterprise.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyEnterpriseData.php");

$resp            = [];
$idStyEnterprise = 1;

if (isset($_POST['idStyEnterprise']) && $_POST['idStyEnterprise'] > 0) {
  $idStyEnterprise = $_POST['idStyEnterprise'];
}

$listUsers = DistriXStyAppUser::listUsers($idStyEnterprise);
$resp["ListUsers"] = $listUsers;

$listEnterprises = DistriXStyAppEnterprise::listEnterprises();
$resp["ListEnterprises"] = $listEnterprises;

echo json_encode($resp);
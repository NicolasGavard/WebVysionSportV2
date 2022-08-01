<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppEnterprise.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyEnterpriseData.php");

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
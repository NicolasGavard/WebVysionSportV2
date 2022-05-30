<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppEnterprise.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyEnterpriseData.php");

$resp             = [];
$idUser           = $_POST['id'];
$user             = DistriXStyAppUser::viewUser($idUser);
$resp["ViewUser"] = $user;

$ListEnterprises  = DistriXStyAppEnterprise::listEnterprises();
$resp["ListEnterprises"]  = $ListEnterprises;

echo json_encode($resp);
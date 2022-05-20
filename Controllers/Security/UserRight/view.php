<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyEnterprise.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyEnterpriseData.php");

$resp             = [];
$idUser           = $_POST['id'];
$user             = DistriXStyUser::viewUser($idUser);
$resp["ViewUser"] = $user;

$ListEnterprises  = DistriXStyEnterprise::listEnterprises();
$resp["ListEnterprises"]  = $ListEnterprises;

echo json_encode($resp);
<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppModule.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyModuleData.php");

$resp               = [];
$idModule           = $_POST['id'];
$module             = DistriXStyAppModule::viewModule($idModule);
$resp["ViewModule"] = $module;

echo json_encode($resp);
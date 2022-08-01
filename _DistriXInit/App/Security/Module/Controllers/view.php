<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppModule.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyModuleData.php");

$resp               = [];
$idModule           = $_POST['id'];
$module             = DistriXStyAppModule::viewModule($idModule);
$resp["ViewModule"] = $module;

echo json_encode($resp);
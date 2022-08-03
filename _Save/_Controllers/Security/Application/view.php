<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppApplication.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyApplicationData.php");

$resp                     = [];
$idApplication            = $_POST['id'];
$application              = DistriXStyAppApplication::viewApplication($idApplication);
$resp["ViewApplication"]  = $application;

echo json_encode($resp);
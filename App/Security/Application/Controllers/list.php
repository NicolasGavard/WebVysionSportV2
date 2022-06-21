<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DISTRIX Security App
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppApplication.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyApplicationData.php");
// DISTRIX Security
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Const/DistriXStyRightConst.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");

session_start();
$resp               = [];
$ListApplications   = array();
$errorData          = "";



if (DistriXStyAppAppInterface::isSecurityOk('DISTRIX', 'DISTRIX_SECURITY', 'SECURITY_APPLICATION', DISTRIX_STY_RIGHT_LIST)) {
  $ListApplications = DistriXStyApplication::listApplications();
} else {
  $infoProfil       = DistriXStyAppInterface::getUserInformation();
  $errorData        = ApplicationErrorData::warningSecurityError(1, $infoProfil->getId());
}
$resp["ListApplications"] = $ListApplications;
$resp["pageRight"]        = $ListApplications;
$resp["errorData"]        = $errorData;

echo json_encode($resp);
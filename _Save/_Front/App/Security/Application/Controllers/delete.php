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

$resp       = [];
$errorData  = null;

session_start();
if (DistriXStyAppInterface::isSecurityOk('DISTRIX', 'DISTRIX_SECURITY', 'SECURITY_APPLICATION', DISTRIX_STY_RIGHT_DELETE)) {
  $distriXStyApplicationData = new DistriXStyAppApplicationData();
  $distriXStyApplicationData->setId($_POST['id']);
  list($confirmSave, $errorData) = DistriXStyApplication::delApplication($distriXStyApplicationData);
  $resp["confirm"]      = $confirmSave;
  if (!$confirmSave) {
    $resp["errorData"]  = $errorData;
  }
} else {
  $infoProfil           = DistriXStyAppInterface::getUserInformation();
  $resp["errorData"]    = ApplicationErrorData::warningSecurityError(1, $infoProfil->getId());
}

echo json_encode($resp);
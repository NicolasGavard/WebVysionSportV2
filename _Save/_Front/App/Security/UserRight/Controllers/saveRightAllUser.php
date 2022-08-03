<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppUserRole.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppUserRight.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyRoleRightData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyUserRoleData.php");

$resp = [];

// Find All User width Role 
$listUserByRole = DistriXStyAppUserRole::viewAllUserByRole($_POST['idStyRole']);
foreach ($listUserByRole as $userRole) {
  $distriStyUserRightData = new DistriXStyUserRightData();
  $distriStyUserRightData->setIdStyUser($userRole->IdStyUser());
  $distriStyUserRightData->setIdStyApplication($_POST['idStyApplication']);
  $distriStyUserRightData->setIdStyModule($_POST['idStyModule']);
  $distriStyUserRightData->setIdStyFunctionality($_POST['idStyFunctionality']);
  $distriStyUserRightData->setSumOfRights($_POST['sumOfRights']);
  list($confirmSave, $errorData) = DistriXStyAppUserRight::saveUserRight($distriStyUserRightData);
}

$resp["ConfirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
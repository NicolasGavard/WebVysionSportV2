<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUserRole.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUserRight.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyRoleRightData.php");
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserRoleData.php");

$resp = [];

// Find All User width Role 
$listUserByRole = DistriXStyUserRole::viewAllUserByRole($_POST['idStyRole']);
foreach ($listUserByRole as $userRole) {
  $distriStyUserRightData = new DistriXStyUserRightData();
  $distriStyUserRightData->setIdStyUser($userRole->IdStyUser());
  $distriStyUserRightData->setIdStyApplication($_POST['idStyApplication']);
  $distriStyUserRightData->setIdStyModule($_POST['idStyModule']);
  $distriStyUserRightData->setIdStyFunctionality($_POST['idStyFunctionality']);
  $distriStyUserRightData->setSumOfRights($_POST['sumOfRights']);
  list($confirmSave, $errorData) = DistriXStyUserRight::saveUserRight($distriStyUserRightData);
}

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
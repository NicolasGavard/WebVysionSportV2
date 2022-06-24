<?php
include(__DIR__ . "/../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../../DistriXSecurity/Data/DistriXStyUserData.php");
// Error
include(__DIR__ . "/../../GlobalData/ApplicationErrorData.php");

$resp                 = [];
$confirmSaveUser      = false;

$distriXStyUserData = new DistriXStyUserData();
if (!empty($_POST['idUser']))   { $distriXStyUserData->setId($_POST['idUser']);}
if (!empty($_POST['password'])) { $distriXStyUserData->setPass($_POST['password']);}
list($confirmSaveUser, $errorData) = DistriXStyAppUser::savePassUser($distriXStyUserData);

if (!$confirmSaveUser) {
  $resp["errorData"] = $errorData;
}

$resp["ConfirmSave"] = $confirmSaveUser;

echo json_encode($resp);
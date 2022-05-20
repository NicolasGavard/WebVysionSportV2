<?php
include(__DIR__ . "/../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../DistriXSecurity/Data/DistriXStyUserData.php");
// Error
include(__DIR__ . "/../../GlobalData/ApplicationErrorData.php");

$resp             = [];
$viewUser         = new DistriXStyUserData();
$confirmSaveUser  = false;

if (!empty($_POST['email'])) { 
  $viewUser   = DistriXStyUser::findUserByEmail($_POST['email']);
  if ($viewUser->getId() == 0) {
    $viewUser = DistriXStyUser::findUserByEmailBackup($_POST['email']);
  }
}

if ($viewUser->getId() > 0){
  $distriXStyUserData = DistriXSvcUtil::setData($viewUser, "DistriXStyUserData");
  $distriXStyUserData->setPass($_POST['password']);
  list($sendMail, $errorData) = DistriXStyUser::saveUser($distriXStyUserData);
}

$resp["confirmSaveUser"] = $confirmSaveUser;

if (!$confirmSaveUser) {
  $resp["errorData"] = $errorData;
}
echo json_encode($resp);
<?php
include(__DIR__ . "/../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../../DistriXSecurity/Data/DistriXStyUserData.php");
// Error
include(__DIR__ . "/../../GlobalData/ApplicationErrorData.php");

$resp       = [];
$viewUser   = new DistriXStyUserData();
$sendMail   = false;


if (!empty($_POST['email'])) { 
  $viewUser   = DistriXStyAppUser::findUserByEmail($_POST['email']);
}

if (!empty($_POST['emailBackup'])) { 
  $viewUser   = DistriXStyAppUser::findUserByEmailBackup($_POST['emailBackup']);
}

if ($viewUser->getId() > 0){
  $userStorData = DistriXSvcUtil::setData($viewUser, "DistriXStyUserData");
  list($sendMail, $errorData) = DistriXStyAppUser::sendMailForgetPassword($userStorData);
}

$resp["viewUser"] = $viewUser;
$resp["sendMail"] = $sendMail;

if (!$sendMail) {
  $resp["errorData"] = $errorData;
}
echo json_encode($resp);
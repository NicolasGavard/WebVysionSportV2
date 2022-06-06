<?php
include(__DIR__ . "/../../DistriXSvc/Config/DistriXFolderPath.php");
include(DISTRIX_FOLDER_PATH_FOR_CONTROLLER . "DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(DISTRIX_FOLDER_PATH_FOR_CONTROLLER . "DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(DISTRIX_FOLDER_PATH_FOR_CONTROLLER . "DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(DISTRIX_FOLDER_PATH_FOR_CONTROLLER . "DistriXSecurity/Data/DistriXStyInfoSessionData.php");
include(DISTRIX_FOLDER_PATH_FOR_CONTROLLER . "DistriXSecurity/Data/DistriXStyUserData.php");
include(DISTRIX_FOLDER_PATH_FOR_CONTROLLER . "DistriXSecurity/Data/DistriXStyRoleData.php");

session_set_cookie_params([
  'SameSite' => 'None',
  'Secure' => true
]);

session_start();
$resp         = [];
$errorData        = [];
$isConnected  = false;
$infoProfil   = new DistriXStyUserData();

if (isset($_POST['login']) && isset($_POST['password'])) {
  list($login, $errorData)  = DistriXStyAppInterface::loginPassword("WEBVYSION_SPORT", $_POST['login'], $_POST['password']);
  $isConnected              = DistriXStyAppInterface::isUserConnected();
  if ($isConnected) {
    $infoProfil             = DistriXStyAppInterface::getUserInformation();
  }
}

$resp["infoProfil"]   = $infoProfil;
$resp["isConnected"]  = $isConnected;
if(!empty($errorData)){
  $resp["error"]      = $errorData;
}

echo json_encode($resp);
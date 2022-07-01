<?php
include(__DIR__ . "/../../../../DistriX/DistriXSvc/Config/DistriXFolderPath.php");
include(__DIR__ . "/../../../../DistriX/DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/Data/DistriXStyRoleData.php");

session_set_cookie_params([
  'SameSite' => 'None',
  'Secure' => true
]);

session_start();
$resp         = [];
$errorData    = [];
$isConnected  = false;
$infoProfil   = new DistriXStyUserData();

if (isset($_POST['login']) && isset($_POST['password'])) {
  list($login, $errorData)  = DistriXStyAppInterface::loginPassword("WEBVYSION_SPORT", $_POST['login'], $_POST['password']);
  $isConnected              = DistriXStyAppInterface::isUserConnected();
  if ($isConnected) {
    $infoProfil             = DistriXStyAppInterface::getUserInformation();
    $resp["infoProfil"]     = $infoProfil;
    $resp["isConnected"]    = $isConnected;
  } else {
    if(!empty($errorData)){
      $resp["error"]      = $errorData;
    }
  }
}
echo json_encode($resp);
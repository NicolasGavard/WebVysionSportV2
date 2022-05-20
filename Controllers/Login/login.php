<?php
include(__DIR__ . "/../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../DistriXSecurity/Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../DistriXSecurity/Data/DistriXStyRoleData.php");

session_start();
$resp                   = [];

if (isset($_POST['login']) && isset($_POST['password'])) {
  $login                = DistriXStyAppInterface::loginPassword("WEBVYSION_SPORT", $_POST['login'], $_POST['password']);
  $isConnected          = DistriXStyAppInterface::isUserConnected();
  $resp["isConnected"]  = $isConnected;
  
  $infoProfil           = [];
  if ($isConnected) {
    $infoProfil         = DistriXStyAppInterface::getUserInformation();
  }
  $resp["infoProfil"]   = $infoProfil;
}

echo json_encode($resp);
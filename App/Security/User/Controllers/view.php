<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Data/DistriXStyUserData.php");

$resp      = [];

if (isset($_POST['id']) && $_POST['id'] > 0) {
  $id           = $_POST['id'];
  $infoProfil   = DistriXStyAppInterface::getUserInformation();
  if ($infoProfil->getId() == $id) {
    $listUsers  = DistriXStyAppUser::user($id);
  }
}

$resp["Users"]  = $listUsers;

echo json_encode($resp);
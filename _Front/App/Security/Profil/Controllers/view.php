<?php
session_start();
include(__DIR__ . "/../../../../DistriX/DistriXSvc/Config/DistriXFolderPath.php");
include(__DIR__ . "/../../../../DistriX/DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/Data/DistriXStyUserData.php");

$resp         = [];
if (isset($_POST['id']) && $_POST['id'] > 0) {
  list($distriXStyUserData, $errorJson)  = DistriXStyUserData::getJsonData($_POST);
  $infoProfil = DistriXStyAppInterface::getUserInformation();
  if ($infoProfil->getId() == $distriXStyUserData->getId()) {
    $distriXStyUserData = DistriXStyAppUser::viewUser($distriXStyUserData->getId());
  }
}

$resp["ViewUser"]  = $distriXStyUserData;

echo json_encode($resp);
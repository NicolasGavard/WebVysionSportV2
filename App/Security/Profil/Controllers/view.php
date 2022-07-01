<?php
include(__DIR__ . "/../../../../DistriX/DistriXSvc/Config/DistriXFolderPath.php");
include(__DIR__ . "/../../../../DistriX/DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/Data/DistriXStyUserData.php");

echo __DIR__ . "/../../../../DistriX/DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php";
echo '<br><br>';

$resp         = [];
$_POST['id']  = 1;

if (isset($_POST['id']) && $_POST['id'] > 0) {
  list($distriXStyUserData, $errorJson)  = DistriXStyUserData::getJsonData($_POST);
  $infoProfil = DistriXStyAppInterface::getUserInformation();
  
  echo $infoProfil->getId().' - '.$distriXStyUserData->getId();
  
  if ($infoProfil->getId() == $distriXStyUserData->getId()) {
    $distriXStyUserData = DistriXStyAppUser::viewUser($distriXStyUserData->getId());
  }
}

$resp["Users"]  = $distriXStyUserData;

echo json_encode($resp);
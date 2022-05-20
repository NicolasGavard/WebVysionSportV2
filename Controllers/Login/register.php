<?php
include(__DIR__ . "/../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../DistriXSecurity/StyAppInterface/DistriXStyEnterprise.php");
include(__DIR__ . "/../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../DistriXSecurity/Data/DistriXStyEnterpriseData.php");
include(__DIR__ . "/../../DistriXSecurity/Data/DistriXStyUserData.php");
// Error
include(__DIR__ . "/../../GlobalData/ApplicationErrorData.php");

$resp                 = [];
$idStyEnterprise      = 0;
$confirmSaveEnterprise= false;
$confirmSaveUser      = false;

if (!empty($_POST['nameEnterprise']) && !empty($_POST['emailEnterprise'])) {
  $distriXStyEnterpriseData =  new DistriXStyEnterpriseData();
  if (!empty($_POST['nameEnterprise']))   { $distriXStyEnterpriseData->setName($_POST['nameEnterprise']);}
  if (!empty($_POST['emailEnterprise']))  { $distriXStyEnterpriseData->setEmail($_POST['emailEnterprise']);}
  if (!empty($_POST['idLanguage']))       { $distriXStyEnterpriseData->setIdLanguage($_POST['idLanguage']);}
  list($confirmSaveEnterprise, $idStyEnterprise, $errorData) = DistriXStyEnterprise::saveEnterprise($distriXStyEnterpriseData);
  
  if (!$confirmSaveEnterprise) {
    $resp["errorData"] = $errorData;
  }
}

if ($confirmSaveEnterprise) {
  $distriXStyUserData = new DistriXStyUserData();
  if (!empty($_POST['login']))      { $distriXStyUserData->setLogin($_POST['login']);}
  if (!empty($_POST['password']))   { $distriXStyUserData->setPass($_POST['password']);}
  if ($idStyEnterprise > 0)         { $distriXStyUserData->setIdStyEnterprise($idStyEnterprise);}
  if (!empty($_POST['name']))       { $distriXStyUserData->setName($_POST['name']);}
  if (!empty($_POST['firstName']))  { $distriXStyUserData->setFirstName($_POST['firstName']);}
  if (!empty($_POST['email']))      { $distriXStyUserData->setEmail($_POST['email']);}
  if (!empty($_POST['phone']))      { $distriXStyUserData->setPhone($_POST['phone']);}
  if (!empty($_POST['initPass']))   { $distriXStyUserData->setInitPass($_POST['initPass']);}
  if (!empty($_POST['idLanguage'])) { $distriXStyUserData->setIdLanguage($_POST['idLanguage']);}
  list($confirmSaveUser, $errorData) = DistriXStyUser::saveUser($distriXStyUserData);
  
  if (!$confirmSaveUser) {
    $resp["errorData"] = $errorData;
  }
}

$resp["confirmSave"] = $confirmSaveUser;

echo json_encode($resp);
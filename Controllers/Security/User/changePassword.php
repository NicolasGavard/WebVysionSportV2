<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");

$distriXStyUserData = new DistriXStyUserData();
$distriXStyUserData->setId($_POST['idUser']);
$distriXStyUserData->setPass($_POST['pass']);

list($confirmChangePassUser, $errorData) = DistriXStyAppUser::savePassUser($distriXStyUserData);
echo $confirmChangePassUser;
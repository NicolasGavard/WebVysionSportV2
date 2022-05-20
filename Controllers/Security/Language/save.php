<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyLanguageData.php");

$resp = [];

$distriXStyLanguageData = new DistriXStyLanguageData();
$distriXStyLanguageData->setId($_POST['id']);
$distriXStyLanguageData->setCode($_POST['code']);
$distriXStyLanguageData->setDescription($_POST['description']);
$distriXStyLanguageData->setLinkToPicture('');
if($_POST['linkToPictureBase64'] != '') { $distriXStyLanguageData->setLinkToPicture($_POST['linkToPictureBase64']);}
$distriXStyLanguageData->setStatus($_POST['statut']);
list($confirmSave, $errorData) = DistriXStyLanguage::saveLanguage($distriXStyLanguageData);

$resp["confirmSave"] = $confirmSave;
if (!$confirmSave) {$resp["errorData"] = $errorData;}
echo json_encode($resp);
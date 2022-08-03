<?php
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableLanguageData.php");

$confirmSave  = false;

list($distriXCodeTableLanguageData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);
if(isset($_POST['base64Img']) && $_POST['base64Img'] != '') { $distriXCodeTableLanguageData->setLinkToPicture($_POST['base64Img']);}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("SaveLanguage");
$servicesCaller->addParameter("data", $distriXCodeTableLanguageData);
$servicesCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Language", "DistriXLanguageDeleteDataSvc", "DelLanguage", $output);

if ($outputok && isset($output["ConfirmSave"])) {
  $confirmSave = $output["ConfirmSave"];
} else {
  $error = $errorData;
}

$resp["ConfirmSave"] = $confirmSave;
if (!empty($error)) {
  $resp["Error"] = $error;
}

echo json_encode($resp);
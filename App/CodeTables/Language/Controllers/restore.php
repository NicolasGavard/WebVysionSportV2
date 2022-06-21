<?php
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");

$confirmSave  = false;

list($distriXCodeTableBandData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("RestoreLanguage");
$servicesCaller->addParameter("data", $distriXCodeTableBandData);
$servicesCaller->setServiceName("TablesCodes/Language/DistriXLanguageRestoreDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Language", "DistriXLanguageDeleteDataSvc", "DelLanguage", $output);

if ($outputok && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
} else {
  $error = $errorData;
}

$resp["confirmSave"]  = $confirmSave;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
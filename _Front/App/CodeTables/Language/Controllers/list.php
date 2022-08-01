<?php
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableLanguageData.php");

$listLanguages  = [];

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

$logOk = logController("Security_Language", "DistriXLanguageDeleteDataSvc", "DelLanguage", $output);

if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
  list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
} else {
  $error              = $errorData;
  $resp["Error"]      = $error;
}

$resp["ListLanguages"]   = $listLanguages;

echo json_encode($resp);
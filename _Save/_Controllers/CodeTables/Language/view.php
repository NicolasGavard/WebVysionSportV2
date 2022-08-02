<?php
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");

list($distriXCodeTableBandData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewLanguage");
$servicesCaller->addParameter("data", $distriXCodeTableBandData);
$servicesCaller->setServiceName("TablesCodes/Language/DistriXLanguageViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_Language", "DistriXLanguageDeleteDataSvc", "DelLanguage", $output);

if ($outputok && isset($output["ViewLanguage"])) {
  $distriXCodeTableBandData = $output["ViewLanguage"];
} else {
  $error = $errorData;
}

$resp["ViewLanguage"]  = $distriXCodeTableBandData;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
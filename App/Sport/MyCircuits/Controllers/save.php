<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCircuitTemplateData.php");

$confirmSave  = false;
list($distriXCircuitTemplateData, $errorJson) = DistriXCircuitTemplateData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("data", $distriXCircuitTemplateData);
$servicesCaller->setServiceName("App/Sport/MyCircuits/Services/DistriXSportMyCircuitsTemplateSaveDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); var_dump($output);

$logOk = logController("Security_CircuitTemplate", "DistriXSportMyCircuitsTemplateSaveDataSvc", "SaveCircuitTemplate", $output);

if ($outputok && isset($output["ConfirmSave"]) && $output["ConfirmSave"]) {
  $confirmSave        = $output["ConfirmSave"];
  $idCircuitTemplate  = $output["idCircuitTemplate"];
} else {
  $error = $errorData;
}

$resp["ConfirmSave"]          = $confirmSave;
if ($_POST['id'] > 0)  {
  $resp["idCircuitTemplate"]  = $idCircuitTemplate;
}
if (!empty($error)) {
  $resp["Error"]              = $error;
}

echo json_encode($resp);
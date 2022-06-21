<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Ticket/Ticket/DistriXTicketTicketData.php");
include(__DIR__ . "/../Data/Ticket/Ticket/DistriXTicketTicketNameData.php");

$confirmSave  = false;

if (isset($_POST)) {
  list($foodType, $jsonError) = DistriXTicketTicketData::getJsonData($_POST);
  list($foodTypeNames, $jsonError) = DistriXTicketTicketNameData::getJsonArray($foodType->getNames());
  $foodType->setNames([]); // Needed to be sent without an array fulfilled with elements that are not data objects. 01 June 22

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setDebugMode(DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE);
  // $servicesCaller->setDebugModeAllLayerOn();
  $servicesCaller->addParameter("data", $foodType);
  $servicesCaller->addParameter("dataNames", $foodTypeNames);
  $servicesCaller->setServiceName("TablesCodes/Ticket/DistriXTicketSaveDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  echo "-*/*/*/*/*/*/*/***/*/*/*/*/-"; print_r($output); echo "-*/*/*/*/*/*/*/***/*/*/*/*/-";

  $logOk = logController("Security_Ticket", "DistriXTicketSaveDataSvc", "SaveTicket", $output);

  if ($outputok && !empty($output) > 0 && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
}
$resp["confirmSave"] = $confirmSave;
if (!empty($error)){
  $resp["Error"] = $error;
}
echo json_encode($resp);
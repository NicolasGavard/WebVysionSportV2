<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/TicketStatus/DistriXCodeTableTicketStatusData.php");
include(__DIR__ . "/../../Data/CodeTables/TicketStatus/DistriXCodeTableTicketStatusNameData.php");

$confirmSave  = false;

if (isset($_POST)) {
  list($ticketStatus, $jsonError)       = DistriXCodeTableTicketStatusData::getJsonData($_POST);
  list($ticketStatusNames, $jsonError)  = DistriXCodeTableTicketStatusNameData::getJsonArray($ticketStatus->getNames());
  $ticketStatus->setNames([]); // Needed to be sent without an array fulfilled with elements that are not data objects. Yvan 01 June 22

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setDebugMode(DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE);
  // $servicesCaller->setDebugModeAllLayerOn();
  $servicesCaller->addParameter("data", $ticketStatus);
  $servicesCaller->addParameter("dataNames", $ticketStatusNames);
  $servicesCaller->setServiceName("TablesCodes/TicketStatus/DistriXTicketStatusSaveDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  echo "-*/*/*/*/*/*/*/***/*/*/*/*/-"; print_r($output); echo "-*/*/*/*/*/*/*/***/*/*/*/*/-";

  $logOk = logController("Security_TicketStatus", "DistriXTicketStatusSaveDataSvc", "SaveTicketStatus", $output);

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
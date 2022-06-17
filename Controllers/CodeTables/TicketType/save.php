<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/TicketType/DistriXCodeTableTicketTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/TicketType/DistriXCodeTableTicketTypeNameData.php");

$confirmSave  = false;

if (isset($_POST)) {
  list($ticketType, $jsonError)       = DistriXCodeTableTicketTypeData::getJsonData($_POST);
  list($ticketTypeNames, $jsonError)  = DistriXCodeTableTicketTypeNameData::getJsonArray($ticketType->getNames());
  $ticketType->setNames([]); // Needed to be sent without an array fulfilled with elements that are not data objects. 01 June 22

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->setDebugMode(DISTRIX_SVC_DATA_LAYER_IN_DEBUG_MODE);
  // $servicesCaller->setDebugModeAllLayerOn();
  $servicesCaller->addParameter("data", $ticketType);
  $servicesCaller->addParameter("dataNames", $ticketTypeNames);
  $servicesCaller->setServiceName("TablesCodes/TicketType/DistriXTicketTypeSaveDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  echo "-*/*/*/*/*/*/*/***/*/*/*/*/-"; print_r($output); echo "-*/*/*/*/*/*/*/***/*/*/*/*/-";

  $logOk = logController("Security_TicketType", "DistriXTicketTypeSaveDataSvc", "SaveTicketType", $output);

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
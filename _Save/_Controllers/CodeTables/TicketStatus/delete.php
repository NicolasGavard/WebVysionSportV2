<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/TicketStatus/DistriXCodeTableTicketStatusData.php");

$confirmSave = false;

if (isset($_POST)) {
  list($ticketStatus, $errorJson) = DistriXCodeTableTicketStatusData::getJsonData($_POST);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $ticketStatus);
  $servicesCaller->setServiceName("TablesCodes/TicketStatus/DistriXTicketStatusDeleteDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  //print_r($output);

  $logOk = logController("Security_TicketStatus", "DistriXTicketStatusDeleteDataSvc", "DelTicketStatus", $output);

  if ($outputok && !empty($output) && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
}
$resp["ConfirmSave"] = $confirmSave;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Ticket/Ticket/DistriXTicketTicketData.php");

$confirmSave = false;

if (isset($_POST)) {
  list($ticket, $errorJson) = DistriXTicketTicketData::getJsonData($_POST);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $ticket);
  $servicesCaller->setServiceName("Ticket/Ticket/DistriXTicketDeleteDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  //print_r($output);

  $logOk = logController("Security_Ticket", "DistriXTicketDeleteDataSvc", "DelTicket", $output);

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
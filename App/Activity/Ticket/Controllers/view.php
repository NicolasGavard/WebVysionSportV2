<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/Ticket/Ticket/DistriXTicketTicketData.php");
include(__DIR__ . "/../Data/Ticket/Ticket/DistriXTicketTicketNameData.php");

if (isset($_POST)) {
  list($ticket, $errorJson) = DistriXTicketTicketData::getJsonData($_POST);
  $listTicketNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $ticket);
  $servicesCaller->setServiceName("TablesCodes/Ticket/DistriXTicketViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_Ticket", "DistriXTicketViewDataSvc", "ViewTicket", $output);

// RESPONSE
  if ($outputok && isset($output["ViewTicket"])) {
    list($ticket, $jsonError) = DistriXTicketTicketData::getJsonData($output["ViewTicket"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewTicketNames"]) && is_array($output["ViewTicketNames"])) {
    list($listTicketNames, $jsonError) = DistriXTicketTicketNameData::getJsonArray($output["ViewTicketNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $ticket->setNames($listTicketNames);
  $ticket->setNbLanguages(count($listTicketNames));
}
$resp["ViewTicket"] = $ticket;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
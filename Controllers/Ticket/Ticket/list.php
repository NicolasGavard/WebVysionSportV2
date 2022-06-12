<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/TicketStatus/DistriXCodeTableTicketStatusData.php");
include(__DIR__ . "/../../Data/Ticket/Ticket/DistriXTicketTicketData.php");
include(__DIR__ . "/../../Data/Ticket/TicketComment/DistriXTicketTicketCommentData.php");

$listTicketStatus       = [];
$listTickets            = [];
$listTicketsComment     = [];
$listTicketsFormFront   = [];
$ListUsers              = [];

if (isset($_POST)) {
  $ListUsers            = DistriXStyAppUser::listUsers();

  // CALL
  $ticketStatusCaller = new DistriXServicesCaller();
  $ticketStatusCaller->setServiceName("TablesCodes/TicketStatus/DistriXTicketStatusListDataSvc.php");

  $ticketsCaller = new DistriXServicesCaller();
  $ticketsCaller->setServiceName("Ticket/Ticket/DistriXTicketListDataSvc.php");
  
  $ticketsCommentCaller = new DistriXServicesCaller();
  $ticketsCommentCaller->setServiceName("Ticket/TicketComment/DistriXTicketCommentListDataSvc.php");
  
  $svc = new DistriXSvc();
  $svc->addToCall("TicketStatus", $ticketStatusCaller);
  $svc->addToCall("Ticket", $ticketsCaller);
  $svc->addToCall("TicketComment", $ticketsCommentCaller);
  $callsOk = $svc->call();

  // RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("TicketStatus"); //print_r($output);
  if ($outputok && isset($output["ListTicketStatus"]) && is_array($output["ListTicketStatus"])) {
    list($listTicketStatus, $jsonError) = DistriXCodeTableTicketStatusData::getJsonArray($output["ListTicketStatus"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("Ticket"); //print_r($output);
  if ($outputok && isset($output["ListTickets"]) && is_array($output["ListTickets"])) {
    list($listTickets, $jsonError) = DistriXTicketTicketData::getJsonArray($output["ListTickets"]);
  } else {
    $error = $errorData;
  }
  
  list($outputok, $output, $errorData) = $svc->getResult("TicketComment"); //print_r($output);
  if ($outputok && isset($output["ListTicketsComment"]) && is_array($output["ListTicketsComment"])) {
    list($listTicketsComment, $jsonError) = DistriXTicketTicketCommentData::getJsonArray($output["ListTicketsComment"]);
  } else {
    $error = $errorData;
  }
  
  // TREATMENT
  foreach ($listTickets as $ticket) {
    $ticketAdvancement  = [];
    $ticketComment      = [];
    $distriXTicketTicketStatusData = new DistriXTicketTicketData();
    $distriXTicketTicketStatusData->setId($ticket->getId());
    $distriXTicketTicketStatusData->setIdUserCreate($ticket->getIdUserCreate());
    $distriXTicketTicketStatusData->setIdUserAssign($ticket->getIdUserAssign());
    foreach ($ListUsers as $user) {
      if ($user->getId() == $ticket->getIdUserCreate()){
        $distriXTicketTicketStatusData->setNameUserCreate($user->getName());
        $distriXTicketTicketStatusData->setFirstNameUserCreate($user->getFirstName());
      }
      if ($user->getId() == $ticket->getIdUserAssign()){
        $distriXTicketTicketStatusData->setNameUserAssign($user->getName());
        $distriXTicketTicketStatusData->setFirstNameUserAssign($user->getFirstName());
      }
    }
    
    $distriXTicketTicketStatusData->setIdTicketStatus($ticket->getIdTicketStatus());
    foreach ($listTicketStatus as $ticketStatus) {
      if ($ticketStatus->getId() == $ticket->getIdTicketStatus()){
        $distriXTicketTicketStatusData->setNameTicketStatus($ticketStatus->getName());
      }
    }
    
    $distriXTicketTicketStatusData->setTitle($ticket->getTitle());
    $distriXTicketTicketStatusData->setDescMessage($ticket->getDescMessage());
    $distriXTicketTicketStatusData->setDate($ticket->getDate());
    $distriXTicketTicketStatusData->setTime($ticket->getTime());
    
    foreach ($listTicketsComment as $ticketComment) {
      if ($ticket->getId() == $ticketComment->getIdTicket()) {
        $distriXTicketTicketCommentData = new DistriXTicketTicketCommentData();
        $distriXTicketTicketCommentData->setId($ticketComment->getId());
        $distriXTicketTicketCommentData->setIdTicket($ticketComment->getIdTicket());
        $distriXTicketTicketCommentData->setIdUserCreate($ticketComment->getIdUserCreate());
        
        foreach ($ListUsers as $user) {
          if ($user->getId() == $ticketComment->getIdUserCreate()){
            $distriXTicketTicketCommentData->setNameUserCreate($user->getName());
            $distriXTicketTicketCommentData->setFirstNameUserCreate($user->getFirstName());
          }
        }
  
        $distriXTicketTicketCommentData->setTitle($ticketComment->getTitle());
        $distriXTicketTicketCommentData->setDescMessage($ticketComment->getDescMessage());
        $distriXTicketTicketCommentData->setDate($ticketComment->getDate());
        $distriXTicketTicketCommentData->setTime($ticketComment->getTime());
  
        $picture = [];
        $distriXTicketTicketCommentData->setPicture($picture);
        $distriXTicketTicketCommentData->setElemState($ticketComment->getElemState());
        $distriXTicketTicketCommentData->setTimestamp($ticketComment->getTimestamp());
        $ticketComment[] = $distriXTicketTicketCommentData;
      }
    }
    $distriXTicketTicketStatusData->setComment($ticketComment);
    
    $picture      = [];
    $advancement  = [];
    $distriXTicketTicketStatusData->setAdvancement($advancement);
    $distriXTicketTicketStatusData->setPicture($picture);
    $distriXTicketTicketStatusData->setElemState($ticket->getElemState());
    $distriXTicketTicketStatusData->setTimestamp($ticket->getTimestamp());
    $listTicketsFormFront[] = $distriXTicketTicketStatusData;
  }
}
$resp["ListTickets"]    = $listTicketsFormFront;
if (!empty($error)) {
  $resp["Error"] = $error;
} 
echo json_encode($resp);

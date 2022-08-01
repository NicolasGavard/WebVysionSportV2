<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ . "/../Data/DistriXTicketTicketData.php");

include(__DIR__ . "/../../TicketComment/Data/DistriXTicketTicketCommentData.php");
include(__DIR__ . "/../../../CodeTables/TicketStatus/Data/DistriXCodeTableTicketStatusData.php");
include(__DIR__ . "/../../../CodeTables/TicketStatus/Data/DistriXCodeTableTicketStatusNameData.php");
include(__DIR__ . "/../../../CodeTables/TicketType/Data/DistriXCodeTableTicketTypeData.php");
include(__DIR__ . "/../../../CodeTables/TicketType/Data/DistriXCodeTableTicketTypeNameData.php");

$listTicketType         = [];
$listTicketTypeNames    = [];
$listTicketTypeFormFront= [];
$listTicketStatus       = [];
$listTickets            = [];
$listTicketsComment     = [];
$listTicketsFormFront   = [];
$listUsers              = [];

if (isset($_POST)) {
  $infoProfil           = DistriXStyAppInterface::getUserInformation();
  $listUsers            = DistriXStyAppUser::listUsers();

  $distriXTicketTicketData = new DistriXTicketTicketData();
  $distriXTicketTicketData->setIdUserCreate($infoProfil->getId());
  $distriXTicketTicketData->setIdUserAssign($infoProfil->getId());

  // CALL
  $ticketStatusCaller = new DistriXServicesCaller();
  $ticketStatusCaller->setServiceName("App/CodeTables/TicketStatus/Services/DistriXTicketStatusListDataSvc.php");

  $ticketTypeCaller = new DistriXServicesCaller();
  $ticketTypeCaller->setServiceName("App/CodeTables/TicketType/Services/DistriXTicketTypeListDataSvc.php");

  $ticketsCaller = new DistriXServicesCaller();
  $ticketsCaller->setServiceName("App/Activity/Ticket/Services/DistriXTicketFindDataSvc.php");
  $ticketsCaller->addParameter("data", $distriXTicketTicketData);

  $ticketsCommentCaller = new DistriXServicesCaller();
  $ticketsCommentCaller->setServiceName("App/Activity/TicketComment/Services/DistriXTicketCommentListDataSvc.php");
  
  $svc = new DistriXSvc();
  $svc->addToCall("TicketStatus", $ticketStatusCaller);
  $svc->addToCall("TicketType", $ticketTypeCaller);
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
  if ($outputok && isset($output["ListTicketStatusNames"]) && is_array($output["ListTicketStatusNames"])) {
    list($listTicketStatusNames, $jsonError) = DistriXCodeTableTicketStatusNameData::getJsonArray($output["ListTicketStatusNames"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("TicketType"); //print_r($output);
  if ($outputok && isset($output["ListTicketTypes"]) && is_array($output["ListTicketTypes"])) {
    list($listTicketType, $jsonError) = DistriXCodeTableTicketTypeData::getJsonArray($output["ListTicketTypes"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ListTicketTypeNames"]) && is_array($output["ListTicketTypeNames"])) {
    list($listTicketTypeNames, $jsonError) = DistriXCodeTableTicketTypeNameData::getJsonArray($output["ListTicketTypeNames"]);
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
  foreach ($listTicketType as $ticketType) {
    foreach ($listTicketTypeNames as $ticketTypeName) {
      if ($ticketType->getId() == $ticketTypeName->getIdTicketType() && $ticketTypeName->getIdLanguage() == $infoProfil->getIdLanguage()){
        $distriXCodeTableTicketTypeData =  new DistriXCodeTableTicketTypeData();
        $distriXCodeTableTicketTypeData->setId($ticketType->getId());
        $distriXCodeTableTicketTypeData->setCode($ticketType->getCode());
        $distriXCodeTableTicketTypeData->setName($ticketTypeName->getName());
        $listTicketTypeFormFront[] = $distriXCodeTableTicketTypeData;
      }
    }
  }
  
  foreach ($listTickets as $ticket) {
    $ticketAdvancement  = [];
    $ticketComment      = [];
    $distriXTicketTicketData = new DistriXTicketTicketData();
    $distriXTicketTicketData->setId($ticket->getId());
    $distriXTicketTicketData->setIdUserCreate($ticket->getIdUserCreate());
    $distriXTicketTicketData->setIdUserAssign($ticket->getIdUserAssign());
    foreach ($listUsers as $user) {
      if ($user->getId() == $ticket->getIdUserCreate()){
        $distriXTicketTicketData->setNameUserCreate($user->getName());
        $distriXTicketTicketData->setFirstNameUserCreate($user->getFirstName());
      }
      if ($user->getId() == $ticket->getIdUserAssign()){
        $distriXTicketTicketData->setNameUserAssign($user->getName());
        $distriXTicketTicketData->setFirstNameUserAssign($user->getFirstName());
      }
    }
    
    $distriXTicketTicketData->setIdTicketType($ticket->getIdTicketType());
    foreach ($listTicketType as $ticketType) {
      if ($ticketType->getId() == $ticket->getIdTicketType()){
        foreach ($listTicketTypeNames as $ticketTypeName) {
          if ($ticketType->getId() == $ticketTypeName->getIdTicketType() && $ticketTypeName->getIdLanguage() == $infoProfil->getIdLanguage()){
            $distriXTicketTicketData->setNameTicketType($ticketTypeName->getName());
          }
        }
      }
    }

    $distriXTicketTicketData->setIdTicketStatus($ticket->getIdTicketStatus());
    foreach ($listTicketStatus as $ticketStatus) {
      if ($ticketStatus->getId() == $ticket->getIdTicketStatus()){
        foreach ($listTicketStatusNames as $ticketStatusName) {
          if ($ticketStatus->getId() == $ticketStatusName->getIdTicketStatus() && $ticketStatusName->getIdLanguage() == $infoProfil->getIdLanguage()){
            $distriXTicketTicketData->setNameTicketStatus($ticketStatusName->getName());
          }
        }
      }
    }
    
    $distriXTicketTicketData->setTitle($ticket->getTitle());
    $distriXTicketTicketData->setDescMessage($ticket->getDescMessage());
    $distriXTicketTicketData->setDate($ticket->getDate());
    $distriXTicketTicketData->setTime($ticket->getTime());
    
    foreach ($listTicketsComment as $ticketComment) {
      if ($ticket->getId() == $ticketComment->getIdTicket()) {
        $distriXTicketTicketCommentData = new DistriXTicketTicketCommentData();
        $distriXTicketTicketCommentData->setId($ticketComment->getId());
        $distriXTicketTicketCommentData->setIdTicket($ticketComment->getIdTicket());
        $distriXTicketTicketCommentData->setIdUserCreate($ticketComment->getIdUserCreate());
        
        foreach ($listUsers as $user) {
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
    $distriXTicketTicketData->setComment($ticketComment);
    
    $picture      = [];
    $advancement  = [];
    $distriXTicketTicketData->setAdvancement($advancement);
    $distriXTicketTicketData->setPicture($picture);
    $distriXTicketTicketData->setElemState($ticket->getElemState());
    $distriXTicketTicketData->setTimestamp($ticket->getTimestamp());
    $listTicketsFormFront[] = $distriXTicketTicketData;
  }
}

$resp["ListTickets"]      = $listTicketsFormFront;
$resp["ListTicketTypes"]  = $listTicketTypeFormFront;
$resp["ListUsers"]        = $listUsers;
if (!empty($error)) {
  $resp["Error"] = $error;
} 
echo json_encode($resp);

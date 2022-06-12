<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/TicketStorData.php");
  // Storage
  include(__DIR__ . "/Storage/TicketStor.php");

  $tickets     = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($tickets, $ticketNames) = TicketStor::getList(true, $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListTicket", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ListTickets", $tickets);

  // Return response
  $dataSvc->endOfService();
}
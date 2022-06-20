<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/TicketStorData.php");
  // Storage
  include(__DIR__ . "/Storage/TicketStor.php");

  $ticket      = new TicketStorData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if (!is_null($dataSvc->getParameter("data"))) {
      list($ticket, $jsonError) = TicketStorData::getJsonData($dataSvc->getParameter("data"));
    }
    list($ticket, $ticketNames) = TicketStor::findByIdUserCreateIdUserAssignDateTime($ticket, $dbConnection);
    // print_r($ticketNamesStor);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListTicket", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("FindTicket", $ticket);

  // Return response
  $dataSvc->endOfService();
}
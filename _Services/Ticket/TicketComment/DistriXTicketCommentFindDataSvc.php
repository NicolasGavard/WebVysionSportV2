<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/TicketCommentStorData.php");
  // Storage
  include(__DIR__ . "/Storage/TicketCommentStor.php");

  $ticketComment      = new TicketCommentStorData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if (!is_null($dataSvc->getParameter("data"))) {
      list($ticketComment, $jsonError) = TicketCommentStorData::getJsonData($dataSvc->getParameter("data"));
    }
    list($ticketComment, $ticketCommentNames) = TicketCommentStor::findByIdUserCreateIdUserAssignDateTime($ticketComment, $dbConnection);
    // print_r($ticketCommentNamesStor);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListTicketComment", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("FindTicketComment", $ticketComment);

  // Return response
  $dataSvc->endOfService();
}
<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/TicketTypeStorData.php");
  include(__DIR__ . "/Data/TicketTypeNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/TicketTypeStor.php");
  include(__DIR__ . "/Storage/TicketTypeNameStor.php");

  // Data
  $ticketType      = new TicketTypeStorData();
  $ticketTypeNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($ticketType, $jsonError)     = TicketTypeStorData::getJsonData($dataSvc->getParameter("data"));
    list($ticketType, $ticketTypeNames) = TicketTypeStor::readNames($ticketType->getId(), $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewTicketType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ViewTicketType", $ticketType);
  $dataSvc->addToResponse("ViewTicketTypeNames", $ticketTypeNames);

// Return response
  $dataSvc->endOfService();
}

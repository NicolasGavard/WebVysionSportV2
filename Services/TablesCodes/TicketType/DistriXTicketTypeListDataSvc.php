<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/TicketTypeStorData.php");
  include(__DIR__ . "/Data/TicketTypeNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/TicketTypeStor.php");
  include(__DIR__ . "/Storage/TicketTypeNameStor.php");

  $ticketType     = [];
  $ticketTypeNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dataName, $jsonError)         = TicketTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
    list($ticketType, $ticketTypeNames) = TicketTypeStor::getListNames(true, $dataName, $dbConnection);
    // list($ticketType, $ticketTypeNames) = TicketTypeStor::getListNames(true, TicketTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"))[0], $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListTicketType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ListTicketTypes", $ticketType);
  $dataSvc->addToResponse("ListTicketTypeNames", $ticketTypeNames);

  // Return response
  $dataSvc->endOfService();
}
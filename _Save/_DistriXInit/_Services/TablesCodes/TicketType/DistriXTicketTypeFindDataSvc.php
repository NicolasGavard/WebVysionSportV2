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

  $ticketType      = new TicketTypeStorData();
  $ticketTypeNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if (!is_null($dataSvc->getParameter("data"))) {
      list($ticketType, $jsonError) = TicketTypeStorData::getJsonData($dataSvc->getParameter("data"));
    }
    $dataName = new TicketTypeNameStorData();
    if (!is_null($dataSvc->getParameter("dataName"))) {
      list($dataName, $jsonError) = TicketTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
    }
    list($ticketType, $ticketTypeNames) = TicketTypeStor::findByIndCodeNames($ticketType, $dataName, $dbConnection);
    // print_r($ticketTypeNamesStor);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListTicketType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("FindTicketType", $ticketType);
  $dataSvc->addToResponse("FindTicketTypeNames", $ticketTypeNames);

  // Return response
  $dataSvc->endOfService();
}
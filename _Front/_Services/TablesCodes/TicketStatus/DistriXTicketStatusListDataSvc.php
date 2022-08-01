<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/TicketStatusStorData.php");
  include(__DIR__ . "/Data/TicketStatusNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/TicketStatusStor.php");
  include(__DIR__ . "/Storage/TicketStatusNameStor.php");

  $ticketStatus     = [];
  $ticketStatusNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dataName, $jsonError) = TicketStatusNameStorData::getJsonData($dataSvc->getParameter("dataName"));
    list($ticketStatus, $ticketStatusNames) = TicketStatusStor::getListNames(true, $dataName, $dbConnection);
    // list($ticketStatus, $ticketStatusNames) = TicketStatusStor::getListNames(true, TicketStatusNameStorData::getJsonData($dataSvc->getParameter("dataName"))[0], $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListTicketStatus", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ListTicketStatus", $ticketStatus);
  $dataSvc->addToResponse("ListTicketStatusNames", $ticketStatusNames);

  // Return response
  $dataSvc->endOfService();
}
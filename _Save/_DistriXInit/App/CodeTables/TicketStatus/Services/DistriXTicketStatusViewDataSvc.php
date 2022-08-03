<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/TicketStatusStorData.php");
include(__DIR__ . "/Data/TicketStatusNameStorData.php");
// Storage
include(__DIR__ . "/Storage/TicketStatusStor.php");
include(__DIR__ . "/Storage/TicketStatusNameStor.php");

// Data
$ticketStatus      = new TicketStatusStorData();
$ticketStatusNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($ticketStatus, $jsonError)     = TicketStatusStorData::getJsonData($dataSvc->getParameter("data"));
  list($ticketStatus, $ticketStatusNames) = TicketStatusStor::readNames($ticketStatus->getId(), $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewTicketStatus", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewTicketStatus", $ticketStatus);
$dataSvc->addToResponse("ViewTicketStatusNames", $ticketStatusNames);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/TicketStatusStorData.php");
include(__DIR__ . "/Data/TicketStatusNameStorData.php");
// Storage
include(__DIR__ . "/Storage/TicketStatusStor.php");
include(__DIR__ . "/Storage/TicketStatusNameStor.php");

$ticketStatus      = new TicketStatusStorData();
$ticketStatusNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if (!is_null($dataSvc->getParameter("data"))) {
    list($ticketStatus, $jsonError) = TicketStatusStorData::getJsonData($dataSvc->getParameter("data"));
  }
  $dataName = new TicketStatusNameStorData();
  if (!is_null($dataSvc->getParameter("dataName"))) {
    list($dataName, $jsonError) = TicketStatusNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  }
  list($ticketStatus, $ticketStatusNames) = TicketStatusStor::findByIndCodeNames($ticketStatus, $dataName, $dbConnection);
  // print_r($ticketStatusNamesStor);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListTicketStatus", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("FindTicketStatus", $ticketStatus);
$dataSvc->addToResponse("FindTicketStatusNames", $ticketStatusNames);

// Return response
$dataSvc->endOfService();
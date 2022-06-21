<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/TicketStatus/DistriXCodeTableTicketStatusData.php");
include(__DIR__ . "/../../Data/CodeTables/TicketStatus/DistriXCodeTableTicketStatusNameData.php");

if (isset($_POST)) {
  list($ticketStatus, $errorJson) = DistriXCodeTableTicketStatusData::getJsonData($_POST);
  $listTicketStatusNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $ticketStatus);
  $servicesCaller->setServiceName("TablesCodes/TicketStatus/DistriXTicketStatusViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_TicketStatus", "DistriXTicketStatusViewDataSvc", "ViewTicketStatus", $output);

// RESPONSE
  if ($outputok && isset($output["ViewTicketStatus"])) {
    list($ticketStatus, $jsonError) = DistriXCodeTableTicketStatusData::getJsonData($output["ViewTicketStatus"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewTicketStatusNames"]) && is_array($output["ViewTicketStatusNames"])) {
    list($listTicketStatusNames, $jsonError) = DistriXCodeTableTicketStatusNameData::getJsonArray($output["ViewTicketStatusNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $ticketStatus->setNames($listTicketStatusNames);
  $ticketStatus->setNbLanguages(count($listTicketStatusNames));
}
$resp["ViewTicketStatus"] = $ticketStatus;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
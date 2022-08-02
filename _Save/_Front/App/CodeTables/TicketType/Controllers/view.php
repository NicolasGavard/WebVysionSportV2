<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableTicketTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableTicketTypeNameData.php");

if (isset($_POST)) {
  list($ticketType, $errorJson) = DistriXCodeTableTicketTypeData::getJsonData($_POST);
  $listTicketTypeNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $ticketType);
  $servicesCaller->setServiceName("App/CodeTables/TicketType/Services/DistriXTicketTypeViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_TicketType", "DistriXTicketTypeViewDataSvc", "ViewTicketType", $output);

// RESPONSE
  if ($outputok && isset($output["ViewTicketType"])) {
    list($ticketType, $jsonError) = DistriXCodeTableTicketTypeData::getJsonData($output["ViewTicketType"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewTicketTypeNames"]) && is_array($output["ViewTicketTypeNames"])) {
    list($listTicketTypeNames, $jsonError) = DistriXCodeTableTicketTypeNameData::getJsonArray($output["ViewTicketTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $ticketType->setNames($listTicketTypeNames);
  $ticketType->setNbLanguages(count($listTicketTypeNames));
}
$resp["ViewTicketType"] = $ticketType;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
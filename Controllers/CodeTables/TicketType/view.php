<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Tickettype/DistriXCodeTableTickettypeData.php");
include(__DIR__ . "/../../Data/CodeTables/Tickettype/DistriXCodeTableTickettypeNameData.php");

if (isset($_POST)) {
  list($tickettype, $errorJson) = DistriXCodeTableTickettypeData::getJsonData($_POST);
  $listTickettypeNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $tickettype);
  $servicesCaller->setServiceName("TablesCodes/Tickettype/DistriXTickettypeViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_Tickettype", "DistriXTickettypeViewDataSvc", "ViewTickettype", $output);

// RESPONSE
  if ($outputok && isset($output["ViewTickettype"])) {
    list($tickettype, $jsonError) = DistriXCodeTableTickettypeData::getJsonData($output["ViewTickettype"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewTickettypeNames"]) && is_array($output["ViewTickettypeNames"])) {
    list($listTickettypeNames, $jsonError) = DistriXCodeTableTickettypeNameData::getJsonArray($output["ViewTickettypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $tickettype->setNames($listTickettypeNames);
  $tickettype->setNbLanguages(count($listTickettypeNames));
}
$resp["ViewTickettype"] = $tickettype;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
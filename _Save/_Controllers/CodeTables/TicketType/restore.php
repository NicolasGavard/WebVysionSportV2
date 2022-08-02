<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/TicketType/DistriXCodeTableTicketTypeData.php");

$confirmSave = false;

// TESTS
// $_POST["id"] = 1;
// $_POST["id"] = 3;
// $_POST["id"] = 4;

if (isset($_POST)) {
  list($ticketType, $errorJson) = DistriXCodeTableTicketTypeData::getJsonData($_POST);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $ticketType);
  $servicesCaller->setServiceName("TablesCodes/TicketType/DistriXTicketTypeRestoreDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); 
  // print_r($output);

  $logOk = logController("Security_TicketType", "DistriXTicketTypeRestoreDataSvc", "RestoreTicketType", $output);

  if ($outputok && !empty($output) && isset($output["ConfirmSave"])) {
    $confirmSave = $output["ConfirmSave"];
  } else {
    $error = $errorData;
  }
}
$resp["ConfirmSave"] = $confirmSave;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
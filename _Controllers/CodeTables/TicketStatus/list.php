<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/TicketStatus/DistriXCodeTableTicketStatusData.php");
include(__DIR__ . "/../../Data/CodeTables/TicketStatus/DistriXCodeTableTicketStatusNameData.php");
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");

$listTicketStatuss = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("TablesCodes/Language/DistriXLanguageListDataSvc.php");

  $dataName = new DistriXCodeTableTicketStatusNameData();

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("TablesCodes/TicketStatus/DistriXTicketStatusListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("TicketStatus", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_TicketStatus", "DistriXTicketStatusListDataSvc", "ListTicketStatus-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }
  list($outputok, $output, $errorData) = $svc->getResult("TicketStatus"); //print_r($output);
  $logOk = logController("Security_TicketStatus", "DistriXTicketStatusListDataSvc", "ListTicketStatus-TicketStatuss", $output);
  if ($outputok && isset($output["ListTicketStatuss"]) && is_array($output["ListTicketStatuss"])) {
    list($listTicketStatuss, $jsonError) = DistriXCodeTableTicketStatusData::getJsonArray($output["ListTicketStatuss"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ListTicketStatusNames"]) && is_array($output["ListTicketStatusNames"])) {
    list($listTicketStatusNames, $jsonError) = DistriXCodeTableTicketStatusNameData::getJsonArray($output["ListTicketStatusNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $nbLanguagesTotal = count($listLanguages);
  foreach ($listTicketStatuss as $ticketStatus) {
    $ticketStatus->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listTicketStatusNames as $ticketStatusName) {
      if ($ticketStatusName->getIdTicketStatus() == $ticketStatus->getId()) {
        $names[] = $ticketStatusName;
      }
    }
    $ticketStatus->setNames($names);
    $ticketStatus->setNbLanguages(count($names));
  }
}
$resp["ListTicketStatuss"] = $listTicketStatuss;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableTicketStatusData.php");
include(__DIR__ . "/../Data/DistriXCodeTableTicketStatusNameData.php");
include(__DIR__ . "/../../Language/Data/DistriXCodeTableLanguageData.php");

$listTicketStatus = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");

  $dataName       = new DistriXCodeTableTicketStatusNameData();
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("App/CodeTables/TicketStatus/Services/DistriXTicketStatusListDataSvc.php");

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
  $logOk = logController("Security_TicketStatus", "DistriXTicketStatusListDataSvc", "ListTicketStatus-TicketStatus", $output);
  if ($outputok && isset($output["ListTicketStatus"]) && is_array($output["ListTicketStatus"])) {
    list($listTicketStatus, $jsonError) = DistriXCodeTableTicketStatusData::getJsonArray($output["ListTicketStatus"]);
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
  foreach ($listTicketStatus as $ticketStatus) {
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
$resp["ListTicketStatus"] = $listTicketStatus;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

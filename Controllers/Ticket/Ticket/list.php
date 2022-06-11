<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/Ticket/Ticket/DistriXTicketTicketData.php");
include(__DIR__ . "/../../Data/Ticket/Ticket/DistriXTicketTicketNameData.php");
include(__DIR__ . "/../../Data/Ticket/Language/DistriXCodeTableLanguageData.php");

$listTickets = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("TablesCodes/Language/DistriXLanguageListDataSvc.php");

  // $infoProfil = DistriXStyAppInterface::getUserInformation();
  // if (empty($_POST['idLanguage'])) {
  //   $_POST['idLanguage'] = $infoProfil->getIdLanguage();
  // }
  // list($dataName, $errorJson) = DistriXTicketTicketNameData::getJsonData($_POST);

  // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  // Pas de langue pour avoir toutes les langues ! Yvan 10-June-22
  // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  $dataName = new DistriXTicketTicketNameData();

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("TablesCodes/Ticket/DistriXTicketListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("Ticket", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_Ticket", "DistriXTicketListDataSvc", "ListTicket-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXTicketLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }
  list($outputok, $output, $errorData) = $svc->getResult("Ticket"); //print_r($output);
  $logOk = logController("Security_Ticket", "DistriXTicketListDataSvc", "ListTicket-Tickets", $output);
  if ($outputok && isset($output["ListTickets"]) && is_array($output["ListTickets"])) {
    list($listTickets, $jsonError) = DistriXTicketTicketData::getJsonArray($output["ListTickets"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ListTicketNames"]) && is_array($output["ListTicketNames"])) {
    list($listTicketNames, $jsonError) = DistriXTicketTicketNameData::getJsonArray($output["ListTicketNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $nbLanguagesTotal = count($listLanguages);
  foreach ($listTickets as $foodType) {
    $foodType->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listTicketNames as $foodTypeName) {
      if ($foodTypeName->getIdTicket() == $foodType->getId()) {
        $names[] = $foodTypeName;
      }
    }
    $foodType->setNames($names);
    $foodType->setNbLanguages(count($names));
  }
}
$resp["ListTickets"] = $listTickets;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

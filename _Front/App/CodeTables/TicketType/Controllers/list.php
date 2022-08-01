<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableTicketTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableTicketTypeNameData.php");
include(__DIR__ . "/../../Language/Data/DistriXCodeTableLanguageData.php");

$listTicketTypes = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");

  $dataName       = new DistriXCodeTableTicketTypeNameData();
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("App/CodeTables/TicketType/Services/DistriXTicketTypeListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("TicketType", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_TicketType", "DistriXTicketTypeListDataSvc", "ListTicketType-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("TicketType"); //print_r($output);
  $logOk = logController("Security_TicketType", "DistriXTicketTypeListDataSvc", "ListTicketType-TicketTypes", $output);
  if ($outputok && isset($output["ListTicketTypes"]) && is_array($output["ListTicketTypes"])) {
    list($listTicketTypes, $jsonError) = DistriXCodeTableTicketTypeData::getJsonArray($output["ListTicketTypes"]);
  } else {
    $error = $errorData;
  }
  
  if ($outputok && isset($output["ListTicketTypeNames"]) && is_array($output["ListTicketTypeNames"])) {
    list($listTicketTypeNames, $jsonError) = DistriXCodeTableTicketTypeNameData::getJsonArray($output["ListTicketTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $nbLanguagesTotal = count($listLanguages);
  foreach ($listTicketTypes as $ticketType) {
    $ticketType->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listTicketTypeNames as $ticketTypeName) {
      if ($ticketTypeName->getIdTicketType() == $ticketType->getId()) {
        $names[] = $ticketTypeName;
      }
    }
    $ticketType->setNames($names);
    $ticketType->setNbLanguages(count($names));
  }
}
$resp["ListTicketTypes"] = $listTicketTypes;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

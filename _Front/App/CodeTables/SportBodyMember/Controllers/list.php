<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableBodyMemberData.php");
include(__DIR__ . "/../Data/DistriXCodeTableBodyMemberNameData.php");
include(__DIR__ . "/../../Language/Data/DistriXCodeTableLanguageData.php");

$listBodyMembers = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");

  $dataName       = new DistriXCodeTableBodyMemberNameData();
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("App/CodeTables/SportBodyMember/Services/DistriXBodyMemberListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("BodyMember", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_BodyMember", "DistriXBodyMemberListDataSvc", "ListBodyMember-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("BodyMember"); //print_r($output);
  $logOk = logController("Security_BodyMember", "DistriXBodyMemberListDataSvc", "ListBodyMember-BodyMembers", $output);
  if ($outputok && isset($output["ListBodyMembers"]) && is_array($output["ListBodyMembers"])) {
    list($listBodyMembers, $jsonError) = DistriXCodeTableBodyMemberData::getJsonArray($output["ListBodyMembers"]);
  } else {
    $error = $errorData;
  }
  
  if ($outputok && isset($output["ListBodyMemberNames"]) && is_array($output["ListBodyMemberNames"])) {
    list($listBodyMemberNames, $jsonError) = DistriXCodeTableBodyMemberNameData::getJsonArray($output["ListBodyMemberNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $nbLanguagesTotal = count($listLanguages);
  foreach ($listBodyMembers as $bodyMember) {
    $bodyMember->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listBodyMemberNames as $bodyMemberName) {
      if ($bodyMemberName->getIdBodyMember() == $bodyMember->getId()) {
        $names[] = $bodyMemberName;
      }
    }
    $bodyMember->setNames($names);
    $bodyMember->setNbLanguages(count($names));
  }
}
$resp["ListBodyMembers"] = $listBodyMembers;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

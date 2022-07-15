<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
// include(__DIR__ . "/../../../../DistriX/DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableBodyMuscleData.php");
include(__DIR__ . "/../Data/DistriXCodeTableBodyMuscleNameData.php");
include(__DIR__ . "/../../Language/Data/DistriXCodeTableLanguageData.php");
include(__DIR__ . "/../../SportBodyMember/Data/DistriXCodeTableBodyMemberData.php");
include(__DIR__ . "/../../SportBodyMember/Data/DistriXCodeTableBodyMemberNameData.php");

$listBodyMuscles = [];
$listBodyMembers = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");

  $dataName       = new DistriXCodeTableBodyMuscleNameData();
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("App/CodeTables/SportBodyMuscle/Services/DistriXBodyMuscleListDataSvc.php");

  $dataMemberName = new DistriXCodeTableBodyMemberNameData();
  $dataMemberName->setIdLanguage(DistriXStyAppInterface::getUserInformation()->getIdLanguage());
  $servicesMemberCaller = new DistriXServicesCaller();
  $servicesMemberCaller->addParameter("dataName", $dataMemberName);
  $servicesMemberCaller->setServiceName("App/CodeTables/SportBodyMember/Services/DistriXBodyMemberListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("BodyMuscle", $servicesCaller);
  $svc->addToCall("BodyMember", $servicesMemberCaller);

  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_BodyMuscle", "DistriXBodyMuscleListDataSvc", "ListBodyMuscle-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("BodyMuscle"); //print_r($output);
  $logOk = logController("Security_BodyMuscle", "DistriXBodyMuscleListDataSvc", "ListBodyMuscle-BodyMuscles", $output);
  if ($outputok && isset($output["ListBodyMuscles"]) && is_array($output["ListBodyMuscles"])) {
    list($listBodyMuscles, $jsonError) = DistriXCodeTableBodyMuscleData::getJsonArray($output["ListBodyMuscles"]);
  } else {
    $error = $errorData;
  }
  
  if ($outputok && isset($output["ListBodyMuscleNames"]) && is_array($output["ListBodyMuscleNames"])) {
    list($listBodyMuscleNames, $jsonError) = DistriXCodeTableBodyMuscleNameData::getJsonArray($output["ListBodyMuscleNames"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("BodyMember"); //print_r($output);
  $logOk = logController("Security_BodyMuscle", "DistriXBodyMemberListDataSvc", "ListBodyMember-BodyMembers", $output);
  if ($outputok && isset($output["ListBodyMembers"]) && is_array($output["ListBodyMembers"])) {
    list($listBodyMembers, $jsonError) = DistriXCodeTableBodyMemberData::getJsonArray($output["ListBodyMembers"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ListBodyMemberNames"]) && is_array($output["ListBodyMemberNames"])) {
    list($listBodyMemberNames, $jsonError) = DistriXCodeTableBodyMemberNameData::getJsonArray($output["ListBodyMemberNames"]);
    foreach ($listBodyMembers as $key => $bodyMember) {
      $names[] = $listBodyMemberNames[$key];
      $bodyMember->setNames($names);
    }
  } else {
    $error = $errorData;
  }


// TREATMENT
  $nbLanguagesTotal = count($listLanguages);
  foreach ($listBodyMuscles as $bodyMuscle) {
    $bodyMuscle->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listBodyMuscleNames as $bodyMuscleName) {
      if ($bodyMuscleName->getIdBodyMuscle() == $bodyMuscle->getId()) {
        $names[] = $bodyMuscleName;
      }
    }
    $bodyMuscle->setNames($names);
    $bodyMuscle->setNbLanguages(count($names));
  
    foreach ($listBodyMemberNames as $bodyMemberName) {
      if ($bodyMuscle->getIdBodyMember() == $bodyMemberName->getIdBodyMember()) {
        $bodyMuscle->setBodyMemberName($bodyMemberName->getName());
      }
    }
  }
}
$resp["ListBodyMuscles"] = $listBodyMuscles;
$resp["ListLanguages"]   = $listLanguages;
$resp["ListBodyMembers"] = $listBodyMembers;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

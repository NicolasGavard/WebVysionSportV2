<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableBodyMemberData.php");
include(__DIR__ . "/../Data/DistriXCodeTableBodyMemberNameData.php");

if (isset($_POST)) {
  list($bodyMember, $errorJson) = DistriXCodeTableBodyMemberData::getJsonData($_POST);
  $listBodyMemberNames = [];

// CALL
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("data", $bodyMember);
  $servicesCaller->setServiceName("App/CodeTables/SportBodyMember/Services/DistriXBodyMemberViewDataSvc.php");
  list($outputok, $output, $errorData) = $servicesCaller->call(); //echo "--";print_r($output);

  $logOk = logController("Security_BodyMember", "DistriXBodyMemberViewDataSvc", "ViewBodyMember", $output);

// RESPONSE
  if ($outputok && isset($output["ViewBodyMember"])) {
    list($bodyMember, $jsonError) = DistriXCodeTableBodyMemberData::getJsonData($output["ViewBodyMember"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ViewBodyMemberNames"]) && is_array($output["ViewBodyMemberNames"])) {
    list($listBodyMemberNames, $jsonError) = DistriXCodeTableBodyMemberNameData::getJsonArray($output["ViewBodyMemberNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $bodyMember->setNames($listBodyMemberNames);
  $bodyMember->setNbLanguages(count($listBodyMemberNames));
}
$resp["ViewBodyMember"] = $bodyMember;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);
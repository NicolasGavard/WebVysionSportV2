<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/BodyMemberStorData.php");
include(__DIR__ . "/Data/BodyMemberNameStorData.php");
// Storage
include(__DIR__ . "/Storage/BodyMemberStor.php");
include(__DIR__ . "/Storage/BodyMemberNameStor.php");

$bodyMember      = new BodyMemberStorData();
$bodyMemberNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if (!is_null($dataSvc->getParameter("data"))) {
    list($bodyMember, $jsonError) = BodyMemberStorData::getJsonData($dataSvc->getParameter("data"));
  }
  $dataName = new BodyMemberNameStorData();
  if (!is_null($dataSvc->getParameter("dataName"))) {
    list($dataName, $jsonError) = BodyMemberNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  }
  list($bodyMember, $bodyMemberNames) = BodyMemberStor::findByIndCodeNames($bodyMember, $dataName, $dbConnection);
  // print_r($bodyMemberNamesStor);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListBodyMember", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("FindBodyMember", $bodyMember);
$dataSvc->addToResponse("FindBodyMemberNames", $bodyMemberNames);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/BodyMemberStorData.php");
include(__DIR__ . "/Data/BodyMemberNameStorData.php");
// Storage
include(__DIR__ . "/Storage/BodyMemberStor.php");
include(__DIR__ . "/Storage/BodyMemberNameStor.php");

$bodyMembers     = [];
$bodyMemberNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($dataName, $jsonError) = BodyMemberNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  list($bodyMembers, $bodyMemberNames) = BodyMemberStor::getListNames(true, $dataName, $dbConnection);
  // list($bodyMembers, $bodyMemberNames) = BodyMemberStor::getListNames(true, BodyMemberNameStorData::getJsonData($dataSvc->getParameter("dataName"))[0], $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListBodyMember", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListBodyMembers", $bodyMembers);
$dataSvc->addToResponse("ListBodyMemberNames", $bodyMemberNames);

// Return response
$dataSvc->endOfService();

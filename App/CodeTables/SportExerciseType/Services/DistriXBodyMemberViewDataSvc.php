<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/BodyMemberStorData.php");
include(__DIR__ . "/Data/BodyMemberNameStorData.php");
// Storage
include(__DIR__ . "/Storage/BodyMemberStor.php");
include(__DIR__ . "/Storage/BodyMemberNameStor.php");

// Data
$bodyMember      = new BodyMemberStorData();
$bodyMemberNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($bodyMember, $jsonError)     = BodyMemberStorData::getJsonData($dataSvc->getParameter("data"));
  list($bodyMember, $bodyMemberNames) = BodyMemberStor::readNames($bodyMember->getId(), $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewBodyMember", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewBodyMember", $bodyMember);
$dataSvc->addToResponse("ViewBodyMemberNames", $bodyMemberNames);

// Return response
$dataSvc->endOfService();

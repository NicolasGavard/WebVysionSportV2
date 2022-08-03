<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/BodyMuscleStorData.php");
include(__DIR__ . "/Data/BodyMuscleNameStorData.php");
// Storage
include(__DIR__ . "/Storage/BodyMuscleStor.php");
include(__DIR__ . "/Storage/BodyMuscleNameStor.php");

$bodyMuscle      = new BodyMuscleStorData();
$bodyMuscleNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if (!is_null($dataSvc->getParameter("data"))) {
    list($bodyMuscle, $jsonError) = BodyMuscleStorData::getJsonData($dataSvc->getParameter("data"));
  }
  $dataName = new BodyMuscleNameStorData();
  if (!is_null($dataSvc->getParameter("dataName"))) {
    list($dataName, $jsonError) = BodyMuscleNameStorData::getJsonData($dataSvc->getParameter("dataName"));
  }
  list($bodyMuscle, $bodyMuscleNames) = BodyMuscleStor::findByIndCodeNames($bodyMuscle, $dataName, $dbConnection);
  // print_r($bodyMuscleNamesStor);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListBodyMuscle", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("FindBodyMuscle", $bodyMuscle);
$dataSvc->addToResponse("FindBodyMuscleNames", $bodyMuscleNames);

// Return response
$dataSvc->endOfService();

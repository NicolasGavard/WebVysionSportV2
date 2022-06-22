<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/WeightTypeNameStorData.php");
include(__DIR__ . "/Data/WeightTypeStorData.php");
include(__DIR__ . "/Data/LanguageStorData.php");
// Storage
include(__DIR__ . "/Storage/WeightTypeNameStor.php");
include(__DIR__ . "/Storage/WeightTypeStor.php");

$weightTypeStor = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($dataLanguage, $jsonError)           = LanguageStorData::getJsonData($dataSvc->getParameter("dataLanguage"));
  list($weightTypeStor, $weightTypeStorInd) = WeightTypeStor::getList(true, $dbConnection);
  foreach ($weightTypeStor as $weightType) {
    $weightTypeNameStorData = new WeightTypeNameStorData();
    $weightTypeNameStorData->setIdWeightType($weightType->getId());
    $weightTypeNameStorData->setIdLanguage($dataLanguage->getId());
    $weightTypeNameStor = WeightTypeNameStor::findByIdWeightTypeIdLanguage($weightTypeNameStorData, $dbConnection);
    if ($weightTypeNameStor->getId() > 0) {
      $weightType->setName($weightTypeNameStor->getName());
    }
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListWeightTypes", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListWeightTypes", $weightTypeStor);

// Return response
$dataSvc->endOfService();

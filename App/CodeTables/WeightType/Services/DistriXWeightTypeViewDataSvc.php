<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/WeightTypeNameStorData.php");
include(__DIR__ . "/Data/WeightTypeStorData.php");
// Storage
include(__DIR__ . "/Storage/WeightTypeNameStor.php");
include(__DIR__ . "/Storage/WeightTypeStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data               = $dataSvc->getParameter("data");
  $weightTypeStor     = WeightTypeStor::read($data->getId(), $dbConnection);
  $weightTypeNameStor = WeightTypeNameStor::read($data->getIdWeightType(), $dbConnection);
  $distriXCodeTableWeightTypeNameData =  new DistriXCodeTableWeightTypeNameData();
  $distriXCodeTableWeightTypeNameData->setId($weightTypeNameStor->getId());
  $distriXCodeTableWeightTypeNameData->setIdWeightType($weightTypeNameStor->getIdWeightType());
  $distriXCodeTableWeightTypeNameData->setIdLanguage($weightTypeNameStor->getIdLanguage());
  $distriXCodeTableWeightTypeNameData->setCode($weightTypeStor->getCode());
  $distriXCodeTableWeightTypeNameData->setName($weightTypeNameStor->getName());
  $distriXCodeTableWeightTypeNameData->setDescription($weightTypeNameStor->getDescription());
  $distriXCodeTableWeightTypeNameData->setAbbreviation($weightTypeNameStor->getAbbreviation());
  $distriXCodeTableWeightTypeNameData->setIsSolid($weightTypeStor->getIsSolid());
  $distriXCodeTableWeightTypeNameData->setIsLiquid($weightTypeStor->getIsLiquid());
  $distriXCodeTableWeightTypeNameData->setIsOther($weightTypeStor->getIsOther());
  $distriXCodeTableWeightTypeNameData->setElemState($weightTypeNameStor->getElemState());
  $distriXCodeTableWeightTypeNameData->setTimestamp($weightTypeNameStor->getTimestamp());
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewWeightType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewWeightType", $distriXCodeTableWeightTypeNameData);

// Return response
$dataSvc->endOfService();
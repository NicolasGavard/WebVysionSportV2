<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/../../../GlobalData/DistriXGeneralIdData.php");
include(__DIR__ . "/Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/Data/DistriXCodeTableWeightTypeNameData.php");
// Database Data
include(__DIR__ . "/Data/WeightTypeNameStorData.php");
include(__DIR__ . "/Data/WeightTypeStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/WeightTypeNameStor.php");
include(__DIR__ . "/Storage/WeightTypeStor.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

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

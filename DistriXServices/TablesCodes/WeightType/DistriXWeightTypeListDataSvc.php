<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
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

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$weightType    = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $dataLanguage = $dataSvc->getParameter("dataLanguage");
  
  list($weightTypeStor, $weightTypeStorInd) = WeightTypeStor::getList(true, $dbConnection);
  foreach ($weightTypeStor as $WeightType) {
    $weightTypeNameStorData = new WeightTypeNameStorData();
    $weightTypeNameStorData->setIdWeightType($WeightType->getId());
    $weightTypeNameStorData->setIdLanguage($dataLanguage->getId());
    $weightTypeNameStor = WeightTypeNameStor::findByWeightTypeIdLanguage($weightTypeNameStorData, $dbConnection);
    
    $distriXCodeTableWeightTypeNameData = new DistriXCodeTableWeightTypeNameData();
    $distriXCodeTableWeightTypeNameData->setId($weightTypeNameStor->getId());
    $distriXCodeTableWeightTypeNameData->setIdWeightType($weightTypeNameStor->getIdWeightType());
    $distriXCodeTableWeightTypeNameData->setIdLanguage($weightTypeNameStor->getIdLanguage());
    $distriXCodeTableWeightTypeNameData->setCode($WeightType->getCode());
    $distriXCodeTableWeightTypeNameData->setName($weightTypeNameStor->getName());
    $distriXCodeTableWeightTypeNameData->setDescription($weightTypeNameStor->getDescription());
    $distriXCodeTableWeightTypeNameData->setAbbreviation($weightTypeNameStor->getAbbreviation());
    $distriXCodeTableWeightTypeNameData->setIsSolid($WeightType->getIsSolid());
    $distriXCodeTableWeightTypeNameData->setIsLiquid($WeightType->getIsLiquid());
    $distriXCodeTableWeightTypeNameData->setIsOther($WeightType->getIsOther());
    $distriXCodeTableWeightTypeNameData->setStatut($WeightType->getStatut());
    $distriXCodeTableWeightTypeNameData->setTimestamp($WeightType->getTimestamp());
    $weightType[] = $distriXCodeTableWeightTypeNameData;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListWeightType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListWeightType", $weightType);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/../../../GlobalData/DistriXGeneralIdData.php");
include(__DIR__ . "/Data/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/Data/DistriXCodeTableNutritionalNameData.php");
// Database Data
include(__DIR__ . "/Data/NutritionalNameStorData.php");
include(__DIR__ . "/Data/NutritionalStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/NutritionalNameStor.php");
include(__DIR__ . "/Storage/NutritionalStor.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$weightType    = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $dataLanguage = $dataSvc->getParameter("dataLanguage");
  
  list($weightTypeStor, $weightTypeStorInd) = NutritionalStor::getList(true, $dbConnection);
  foreach ($weightTypeStor as $Nutritional) {
    $weightTypeNameStorData = new NutritionalNameStorData();
    $weightTypeNameStorData->setIdNutritional($Nutritional->getId());
    $weightTypeNameStorData->setIdLanguage($dataLanguage->getId());
    $weightTypeNameStor = NutritionalNameStor::findByNutritionalIdLanguage($weightTypeNameStorData, $dbConnection);
    
    $distriXCodeTableNutritionalNameData =  new DistriXCodeTableNutritionalNameData();
    $distriXCodeTableNutritionalNameData->setId($weightTypeNameStor->getId());
    $distriXCodeTableNutritionalNameData->setIdNutritional($weightTypeNameStor->getIdNutritional());
    $distriXCodeTableNutritionalNameData->setIdLanguage($weightTypeNameStor->getIdLanguage());
    $distriXCodeTableNutritionalNameData->setCode($Nutritional->getCode());
    $distriXCodeTableNutritionalNameData->setName($weightTypeNameStor->getName());
    $distriXCodeTableNutritionalNameData->setStatut($Nutritional->getStatut());
    $distriXCodeTableNutritionalNameData->setTimestamp($Nutritional->getTimestamp());
    $weightType[]  = $distriXCodeTableNutritionalNameData;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListNutritional", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListNutritional", $weightType);

// Return response
$dataSvc->endOfService();

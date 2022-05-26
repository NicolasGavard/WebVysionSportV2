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

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data                 = $dataSvc->getParameter("data");
  $nutritionalStor      = NutritionalStor::read($data->getId(), $dbConnection);
  $nutritionalNameStor  = NutritionalNameStor::read($data->getIdNutritional(), $dbConnection);
  $distriXCodeTableNutritionalNameData =  new DistriXCodeTableNutritionalNameData();
  $distriXCodeTableNutritionalNameData->setId($nutritionalNameStor->getId());
  $distriXCodeTableNutritionalNameData->setIdNutritional($nutritionalNameStor->getIdNutritional());
  $distriXCodeTableNutritionalNameData->setIdLanguage($nutritionalNameStor->getIdLanguage());
  $distriXCodeTableNutritionalNameData->setCode($nutritionalStor->getCode());
  $distriXCodeTableNutritionalNameData->setName($nutritionalNameStor->getName());
  $distriXCodeTableNutritionalNameData->setStatut($nutritionalNameStor->getStatut());
  $distriXCodeTableNutritionalNameData->setTimestamp($nutritionalNameStor->getTimestamp());
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewNutritional", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewNutritional", $distriXCodeTableNutritionalNameData);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/../../../GlobalData/DistriXGeneralIdData.php");
include(__DIR__ . "/Data/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/Data/DistriXCodeTableFoodCategoryNameData.php");
// Database Data
include(__DIR__ . "/Data/CategoryNameStorData.php");
include(__DIR__ . "/Data/CategoryStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/CategoryNameStor.php");
include(__DIR__ . "/Storage/CategoryStor.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data                 = $dataSvc->getParameter("data");
  $nutritionalStor      = CategoryStor::read($data->getId(), $dbConnection);
  $nutritionalNameStor  = CategoryNameStor::read($data->getIdCategory(), $dbConnection);
  $distriXCodeTableFoodCategoryNameData =  new DistriXCodeTableFoodCategoryNameData();
  $distriXCodeTableFoodCategoryNameData->setId($nutritionalNameStor->getId());
  $distriXCodeTableFoodCategoryNameData->setIdCategory($nutritionalNameStor->getIdCategory());
  $distriXCodeTableFoodCategoryNameData->setIdLanguage($nutritionalNameStor->getIdLanguage());
  $distriXCodeTableFoodCategoryNameData->setCode($nutritionalStor->getCode());
  $distriXCodeTableFoodCategoryNameData->setName($nutritionalNameStor->getName());
  $distriXCodeTableFoodCategoryNameData->setElemState($nutritionalNameStor->getElemState());
  $distriXCodeTableFoodCategoryNameData->setTimestamp($nutritionalNameStor->getTimestamp());
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewFoodCategory", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewFoodCategory", $distriXCodeTableFoodCategoryNameData);

// Return response
$dataSvc->endOfService();

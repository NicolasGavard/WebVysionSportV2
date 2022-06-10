<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
if ($dataSvc)
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/NutritionalNameStorData.php");
include(__DIR__ . "/Data/NutritionalStorData.php");
include(__DIR__ . "/Data/LanguageStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/NutritionalNameStor.php");
include(__DIR__ . "/Storage/NutritionalStor.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$nutritional    = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($dataLanguage, $jsonError)           = LanguageStorData::getJsonData($dataSvc->getParameter("dataLanguage"));
  list($nutritionalStor, $nutritionalStorInd) = NutritionalStor::getList(true, $dbConnection);
  foreach ($nutritionalStor as $nutritional) {
    $nutritionalNameStorData = new NutritionalNameStorData();
    $nutritionalNameStorData->setIdNutritional($nutritional->getId());
    $nutritionalNameStorData->setIdLanguage($dataLanguage->getId());
    $nutritionalNameStor = NutritionalNameStor::findByIdNutritionalIdLanguage($nutritionalNameStorData, $dbConnection);
    if ($nutritionalNameStor->getId() > 0) {
      $nutritional->setName($nutritionalNameStor->getName());
    }
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListNutritionals", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListNutritionals", $nutritionalStor);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/NutritionalNameStorData.php");
  include(__DIR__ . "/Data/NutritionalStorData.php");
  include(__DIR__ . "/Data/LanguageStorData.php");
  // Storage
  include(__DIR__ . "/Storage/NutritionalNameStor.php");
  include(__DIR__ . "/Storage/NutritionalStor.php");

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dataName, $jsonError)       = NutritionalNameStorData::getJsonData($dataSvc->getParameter("dataName"));
    list($nutritionals, $nutritionalNames)  = NutritionalStor::getListNames(true, $dataName, $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListNutritionals", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ListNutritionals", $nutritionals);
  $dataSvc->addToResponse("ListNutritionalNames", $nutritionalNames);
}

// Return response
$dataSvc->endOfService();

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
    list($data, $jsonError)         = NutritionalStorData::getJsonData($dataSvc->getParameter("data"));
    list($dataLanguage, $jsonError) = NutritionalStorData::getJsonData($dataSvc->getParameter("dataLanguage"));
    
    print_r($data);
    print_r($dataLanguage);
    
    $nutritionalStorData            = NutritionalStor::read($data->getId(), $dbConnection);
    
    $nutritionalNameStorData = new NutritionalNameStorData();
    $nutritionalNameStorData->setIdNutritional($nutritionalStorData->getId());
    $nutritionalNameStorData->setIdLanguage($dataLanguage->getId());
    $nutritionalNameStor = NutritionalNameStor::findByIdNutritionalIdLanguage($nutritionalNameStorData, $dbConnection);
    if ($nutritionalNameStor->getId() > 0) {
      $nutritionalStorData->setName($nutritionalNameStor->getName());
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewNutritional", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ViewNutritional", $nutritionalStorData);
}

// Return response
$dataSvc->endOfService();

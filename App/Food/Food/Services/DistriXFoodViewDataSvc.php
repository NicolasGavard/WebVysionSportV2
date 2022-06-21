<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Data
  include(__DIR__ . "/Data/LanguageStorData.php");
  include(__DIR__ . "/Data/FoodStorData.php");
  include(__DIR__ . "/Data/FoodNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/FoodStor.php");
  include(__DIR__ . "/Storage/FoodNameStor.php");
  
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dataLanguage, $jsonError) = LanguageStorData::getJsonData($dataSvc->getParameter("dataLanguage"));
    list($foodStorData, $jsonError) = FoodStorData::getJsonData($dataSvc->getParameter("data"));
    $foodStor                       = FoodStor::read($foodStorData->getId(), $dbConnection);
   
    $foodNameStorData               = new FoodNameStorData();
    $foodNameStorData->setIdFood($foodStor->getId());
    $foodNameStorData->setIdLanguage($dataLanguage->getId());
    $foodNameStor                   = FoodNameStor::findByIdFoodIdLanguage($foodNameStorData, $dbConnection);
    if ($foodNameStor->getId() > 0) {
      $foodStor->setName($foodNameStor->getName());
    }

  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ViewMyFood", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ViewFood", $foodStor);
}
// Return response
$dataSvc->endOfService();

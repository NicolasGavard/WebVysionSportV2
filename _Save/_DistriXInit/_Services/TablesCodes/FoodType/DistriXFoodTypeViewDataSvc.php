<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/FoodTypeStorData.php");
  include(__DIR__ . "/Data/FoodTypeNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/FoodTypeStor.php");
  include(__DIR__ . "/Storage/FoodTypeNameStor.php");

  // Data
  $foodType      = new FoodTypeStorData();
  $foodTypeNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($foodType, $jsonError)     = FoodTypeStorData::getJsonData($dataSvc->getParameter("data"));
    list($foodType, $foodTypeNames) = FoodTypeStor::readNames($foodType->getId(), $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewFoodType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ViewFoodType", $foodType);
  $dataSvc->addToResponse("ViewFoodTypeNames", $foodTypeNames);

// Return response
  $dataSvc->endOfService();
}

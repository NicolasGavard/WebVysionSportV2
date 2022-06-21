<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/MealTypeStorData.php");
  include(__DIR__ . "/Data/MealTypeNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/MealTypeStor.php");
  include(__DIR__ . "/Storage/MealTypeNameStor.php");
  
  $mealType      = new MealTypeStorData();
  $mealTypeNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($mealType, $jsonError)     = MealTypeStorData::getJsonData($dataSvc->getParameter("data"));
    list($mealType, $mealTypeNames) = MealTypeStor::readNames($mealType->getId(), $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewMealType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ViewMealType", $mealType);
  $dataSvc->addToResponse("ViewMealTypeNames", $mealTypeNames);

// Return response
  $dataSvc->endOfService();
}

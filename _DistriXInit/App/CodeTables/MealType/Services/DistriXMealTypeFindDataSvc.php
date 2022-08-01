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
    if (!is_null($dataSvc->getParameter("data"))) {
      list($mealType, $jsonError) = MealTypeStorData::getJsonData($dataSvc->getParameter("data"));
    }
    $dataName = new MealTypeNameStorData();
    if (!is_null($dataSvc->getParameter("dataName"))) {
      list($dataName, $jsonError) = MealTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
    }
    list($mealType, $mealTypeNames) = MealTypeStor::findByIndCodeNames($mealType, $dataName, $dbConnection);
    // print_r($mealTypeNamesStor);
    
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListMealType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("FindMealType", $mealType);
  $dataSvc->addToResponse("FindMealTypeNames", $mealTypeNames);

  // Return response
  $dataSvc->endOfService();
}
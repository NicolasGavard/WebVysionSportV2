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

  $mealTypes     = [];
  $mealTypeNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dataName, $jsonError)       = MealTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
    list($mealTypes, $mealTypeNames)  = MealTypeStor::getListNames(true, $dataName, $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListMealType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ListMealTypes", $mealTypes);
  $dataSvc->addToResponse("ListMealTypeNames", $mealTypeNames);

  // Return response
  $dataSvc->endOfService();
}
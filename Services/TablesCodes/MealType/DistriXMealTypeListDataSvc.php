<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include(__DIR__ . "/Init/DistriXMealTypeInitDataSvc.php");
if ($dataSvc->isAuthorized()) {
  $mealTypes     = [];
  $mealTypeNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dataName, $jsonError) = MealTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
    list($mealTypes, $mealTypeNames) = MealTypeStor::getListNames(true, $dataName, $dbConnection);
    // list($mealTypes, $mealTypeNames) = MealTypeStor::getListNames(true, MealTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"))[0], $dbConnection);
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
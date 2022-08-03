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

  $foodTypes     = [];
  $foodTypeNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dataName, $jsonError) = FoodTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
    list($foodTypes, $foodTypeNames) = FoodTypeStor::getListNames(true, $dataName, $dbConnection);
    // list($foodTypes, $foodTypeNames) = FoodTypeStor::getListNames(true, FoodTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"))[0], $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListFoodType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ListFoodTypes", $foodTypes);
  $dataSvc->addToResponse("ListFoodTypeNames", $foodTypeNames);

  // Return response
  $dataSvc->endOfService();
}
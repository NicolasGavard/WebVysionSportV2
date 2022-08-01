<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Storage
  include(__DIR__ . "/Storage/FoodNutritionalStor.php");
  // STOR Data
  include(__DIR__ . "/Data/FoodNutritionalStorData.php");

  $foodNutritionalStor= [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($foodNutritionalStor, $foodNutritionalStorInd) = FoodNutritionalStor::getList(true, $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListFoodNutritionals", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ListFoodNutritionals", $foodNutritionalStor);
}

// Return response
$dataSvc->endOfService();

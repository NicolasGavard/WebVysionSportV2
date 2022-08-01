<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/CategoryFoodTypeStorData.php");
  include(__DIR__ . "/Data/CategoryFoodTypeNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/CategoryFoodTypeStor.php");
  include(__DIR__ . "/Storage/CategoryFoodTypeNameStor.php");

  // Data
  $categoryFoodType      = new CategoryFoodTypeStorData();
  $categoryFoodTypeNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($categoryFoodType, $jsonError) = CategoryFoodTypeStorData::getJsonData($dataSvc->getParameter("data"));
    list($categoryFoodType, $categoryFoodTypeNames) = CategoryFoodTypeStor::readNames($categoryFoodType->getId(), $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewCategoryFoodType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ViewCategoryFoodType", $categoryFoodType);
  $dataSvc->addToResponse("ViewCategoryFoodTypeNames", $categoryFoodTypeNames);

// Return response
  $dataSvc->endOfService();
}

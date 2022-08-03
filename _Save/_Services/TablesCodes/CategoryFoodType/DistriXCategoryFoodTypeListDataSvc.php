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

  $categoryFoodTypes     = [];
  $categoryFoodTypeNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dataName, $jsonError) = CategoryFoodTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
    list($categoryFoodTypes, $categoryFoodTypeNames) = CategoryFoodTypeStor::getListNames(true, $dataName, $dbConnection);
    // list($categoryFoodTypes, $categoryFoodTypeNames) = CategoryFoodTypeStor::getListNames(true, CategoryFoodTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"))[0], $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListCategoryFoodType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ListCategoryFoodTypes", $categoryFoodTypes);
  $dataSvc->addToResponse("ListCategoryFoodTypeNames", $categoryFoodTypeNames);

  // Return response
  $dataSvc->endOfService();
}
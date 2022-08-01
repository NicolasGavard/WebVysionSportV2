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

  $categoryfoodType      = new CategoryFoodTypeStorData();
  $categoryfoodTypeNames = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if (!is_null($dataSvc->getParameter("data"))) {
      list($categoryfoodType, $jsonError) = CategoryFoodTypeStorData::getJsonData($dataSvc->getParameter("data"));
    }
    $dataName = new CategoryFoodTypeNameStorData();
    if (!is_null($dataSvc->getParameter("dataName"))) {
      list($dataName, $jsonError) = CategoryFoodTypeNameStorData::getJsonData($dataSvc->getParameter("dataName"));
    }
    list($categoryfoodType, $categoryfoodTypeNames) = CategoryFoodTypeStor::findByIndCodeNames($categoryfoodType, $dataName, $dbConnection);
    // print_r($categoryfoodTypeNamesStor);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListCategoryFoodType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("FindCategoryFoodType", $categoryfoodType);
  $dataSvc->addToResponse("FindCategoryFoodTypeNames", $categoryfoodTypeNames);

  // Return response
  $dataSvc->endOfService();
}
<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../Init/DataSvcInit.php");


if ($dataSvc->isAuthorized()) {
  include(__DIR__ . "/Data/LanguageStorData.php");
  include(__DIR__ . "/Data/FoodStorData.php");
  include(__DIR__ . "/Data/FoodNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/FoodStor.php");
  include(__DIR__ . "/Storage/FoodNameStor.php");

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dataLanguage, $jsonError) = LanguageStorData::getJsonData($dataSvc->getParameter("dataLanguage"));
    list($foodStor, $foodStorInd)   = FoodStor::getList(true, $dbConnection);
    foreach ($foodStor as $food) {
      $foodNameStorData = new FoodNameStorData();
      $foodNameStorData->setIdFood($food->getId());
      $foodNameStorData->setIdLanguage($dataLanguage->getId());
      $foodNameStor = FoodNameStor::findByIdFoodIdLanguage($foodNameStorData, $dbConnection);
      if ($foodNameStor->getId() > 0) {
        $food->setName($foodNameStor->getName());
      }
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListFoods", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ListFoods", $foodStor);

  // Return response
  $dataSvc->endOfService();
} else {
  die();
}
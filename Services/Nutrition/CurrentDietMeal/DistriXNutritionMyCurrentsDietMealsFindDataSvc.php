<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Storage
  include(__DIR__ . "/../Storage/DietMealStor.php");
  // STOR Data
  include(__DIR__ . "/../Data/DietMealStorData.php");
  if (is_null($dbConnection->getError())) {
    list($dietMealStorData, $jsonError) = DietMealStorData::getJsonData($dataSvc->getParameter("data"));

    if ($dietMealStorData->getIdDiet() > 0 ){
      list($dietMealStor, $dietMealStorInd) = DietMealStor::findByIdDiet($data, true, $dbConnection);
    }
    
    if ($dietMealStorData->getIdDietRecipe() > 0 ){
      list($dietMealStor, $dietMealStorInd) = DietMealStor::findByIdDietRecipe($data, true, $dbConnection);
    }
    
    if ($dietMealStorData->getIdMealType() > 0 ){
      list($dietMealStor, $dietMealStorInd) = DietMealStor::findByIdMealType($data, true, $dbConnection);
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListDietMeals", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ListDietMeals", $dietMealStor);
}

// Return response
$dataSvc->endOfService();

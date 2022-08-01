<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Storage
  include(__DIR__ . "/Storage/DietMealStor.php");
  // STOR Data
  include(__DIR__ . "/Data/DietMealStorData.php");
  
  $dbConnection     = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dietMealStorData, $jsonError) = DietMealStorData::getJsonData($dataSvc->getParameter("data"));

    if ($dietMealStorData->getIdDiet() > 0 ){
      list($dietMealStor, $dietMealStorInd) = DietMealStor::findByIdDiet($dietMealStorData, true, $dbConnection);
    }
    
    if ($dietMealStorData->getIdDietRecipe() > 0 ){
      list($dietMealStor, $dietMealStorInd) = DietMealStor::findByIdDietRecipe($dietMealStorData, true, $dbConnection);
    }
    
    if ($dietMealStorData->getIdMealType() > 0 ){
      list($dietMealStor, $dietMealStorInd) = DietMealStor::findByIdMealType($dietMealStorData, true, $dbConnection);
    }

    if (
      $dietMealStorData->getIdDiet()            &&
      $dietMealStorData->getIdDietRecipe() > 0  &&
      $dietMealStorData->getIdMealType() > 0    &&
      $dietMealStorData->getDayNumber() > 0         
    ){
      list($dietMealStor, $dietMealStorInd) = DietMealStor::findByIdDietIdDietRecipeDayNumberIdMealType($dietMealStorData, $dbConnection);
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

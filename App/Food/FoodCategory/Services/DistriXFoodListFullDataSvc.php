<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/FoodStorData.php");
// Storage
include(__DIR__ . "/Storage/FoodStor.php");
// Cdn Location
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnFolderConst.php");

$foodStor        = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  foreach ($listFoods as $food) {
    $distriXFoodFoodData = new DistriXFoodFoodData();
    $distriXFoodFoodData->setId($food->getId());
    $distriXFoodFoodData->setIdBrand($food->getIdBrand());
    
    foreach ($listBrands as $brand) {
      if ($brand->getId() == $food->getIdBrand()){
        $distriXFoodFoodData->setNameBrand($brand->getName());
        $distriXFoodFoodData->setPictureBrand($brand->getLinkToPicture());
      }
    }
  
    $distriXFoodFoodData->setIdScoreEco($food->getIdScoreEco());
    foreach ($listEcoScores as $ecoScore) {
      if ($ecoScore->getId() == $food->getIdScoreEco()){
        $distriXFoodFoodData->setPictureScoreEco($ecoScore->getLinkToPicture());
      }
    }
    
    $distriXFoodFoodData->setIdScoreNova($food->getIdScoreNova());
    foreach ($listNovaScores as $novaScore) {
      if ($novaScore->getId() == $food->getIdScoreNova()){
        $distriXFoodFoodData->setPictureScoreNova($novaScore->getLinkToPicture());
      }
    }
    
    $distriXFoodFoodData->setIdScoreNutri($food->getIdScoreNutri());
    foreach ($listNutriScores as $nutriScore) {
      if ($nutriScore->getId() == $food->getIdScoreNutri()){
        $distriXFoodFoodData->setPictureScoreNutri($nutriScore->getLinkToPicture());
      }
    }
  
    $distriXFoodFoodData->setCode($code);
    $distriXFoodFoodData->setName($name);
    $distriXFoodFoodData->setDescription($description);
    $distriXFoodFoodData->setFoodCategories($foodCategories);
    $distriXFoodFoodData->setFoodLabels($foodLabels);
    $distriXFoodFoodData->setFoodNutritionals($foodNutritionals);
    $distriXFoodFoodData->setFoodWeights($foodWeights);
    $distriXFoodFoodData->setElemState($elemState);
    $distriXFoodFoodData->setTimestamp($timestamp);
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

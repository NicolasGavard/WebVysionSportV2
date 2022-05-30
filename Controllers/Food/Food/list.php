<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA GENERAL
include(__DIR__ . "/../../Data/DistriXGeneralIdData.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodFoodData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableFoodCategoryNameData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableLanguageData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableNutritionalNameData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeNameData.php");
include(__DIR__ . "/../../Data/DistriXFoodBrandData.php");
include(__DIR__ . "/../../Data/DistriXFoodLabelData.php");
include(__DIR__ . "/../../Data/DistriXFoodNutritionalData.php");
include(__DIR__ . "/../../Data/DistriXFoodEcoScoreData.php");
include(__DIR__ . "/../../Data/DistriXFoodNovaScoreData.php");
include(__DIR__ . "/../../Data/DistriXFoodNutriScoreData.php");
include(__DIR__ . "/../../Data/DistriXFoodWeightData.php");

include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeNameData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

session_start();
$error              = [];
$output             = [];
$outputok           = false;

$resp               = [];
$listFoodFormFront  = [];
$listFoods          = [];
$listWeightTypes    = [];
$listBrands         = [];
$listLabels         = [];
$listEcoScores      = [];
$listNovaScores     = [];
$listNutriScores    = [];

$servicesCaller     = new DistriXServicesCaller();

$infoProfil[0]['idLanguage'] = 1;
$_POST['id'] = $infoProfil[0]['idLanguage']; // NG 27-05-22 - until a solution is found
list($distriXCodeTableLanguageData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListFoods");
$servicesCaller->setServiceName("DistriXServices/Food/Food/DistriXFoodListBusSvc.php");
$servicesCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

if ($outputok && isset($output["ListFoods"]) && is_array($output["ListFoods"])) {
  list($listFoods, $jsonError) = DistriXFoodFoodData::getJsonArray($output["ListFoods"]);
} else {
  $resp["Error"]      = $errorData;
}

if ($outputok && isset($output["ListBrands"]) && is_array($output["ListBrands"])) {
  list($listBrands, $jsonError) = DistriXFoodBrandData::getJsonArray($output["ListBrands"]);
} else {
  $resp["Error"]      = $errorData;
}

if ($outputok && isset($output["ListLabels"]) && is_array($output["ListLabels"])) {
  list($listLabels, $jsonError) = DistriXFoodLabelData::getJsonArray($output["ListLabels"]);
} else {
  $resp["Error"]      = $errorData;
}

if ($outputok && isset($output["ListEcoScores"]) && is_array($output["ListEcoScores"])) {
  list($listEcoScores, $jsonError) = DistriXFoodEcoScoreData::getJsonArray($output["ListEcoScores"]);
} else {
  $resp["Error"]      = $errorData;
}

if ($outputok && isset($output["ListNovaScores"]) && is_array($output["ListNovaScores"])) {
  list($listNovaScores, $jsonError) = DistriXFoodNovaScoreData::getJsonArray($output["ListNovaScores"]);
} else {
  $resp["Error"]      = $errorData;
}

if ($outputok && isset($output["ListNutriScores"]) && is_array($output["ListNutriScores"])) {
  list($listNutriScores, $jsonError) = DistriXFoodNutriScoreData::getJsonArray($output["ListNutriScores"]);
} else {
  $resp["Error"]      = $errorData;
}


foreach ($listFoods as $food) {
  $distriXFoodFoodData = new DistriXFoodFoodData();
  $distriXFoodFoodData->setId($food->getId());
  $distriXFoodFoodData->setIdBrand($food->getIdBrand());
  $distriXFoodFoodData->setIdScoreNutri($food->getIdScoreNutri());
  $distriXFoodFoodData->setIdScoreNova($food->getIdScoreNova());
  $distriXFoodFoodData->setIdScoreEco($food->getIdScoreEco());
  $distriXFoodFoodData->setCode($food->getCode());
  $distriXFoodFoodData->setName($food->getName());
  $distriXFoodFoodData->setDescription($food->getDescription());
  $distriXFoodFoodData->setElemState($food->getElemState());
  $distriXFoodFoodData->setTimestamp($food->getTimestamp());


  foreach ($listBrands as $brand) {
    if ($food->getId() == $brand->getId()) {
      $distriXFoodFoodData->setNameBrand($brand->getName());
      $distriXFoodFoodData->setPictureBrand($brand->getLinkToPicture());
    }
  }

  foreach ($listEcoScores as $ecoScore) {
    if ($food->getidScoreEco() == $ecoScore->getId()) {
      $distriXFoodFoodData->setPictureScoreEco($ecoScore->getLinkToPicture());
    }
  }

  foreach ($listNovaScores as $novaScore) {
    if ($food->getIdScoreNova() == $novaScore->getId()) {
      $distriXFoodFoodData->setPictureScoreNova($novaScore->getLinkToPicture());
    }
  }

  foreach ($listNutriScores as $nutriScore) {
    if ($food->getIdScoreNutri() == $nutriScore->getId()) {
      $distriXFoodFoodData->setPictureScoreNutri($nutriScore->getLinkToPicture());
    }
  }

  $listFoodFormFront[] = $distriXFoodFoodData;
}

$resp["ListFoods"]        = $listFoodFormFront;
$resp["ListBrands"]       = $listBrands;
$resp["ListLabels"]       = $listLabels;
$resp["ListEcoScores"]    = $listEcoScores;
$resp["ListNovaScores"]   = $listNovaScores;
$resp["ListNutriScores"]  = $listNutriScores;

if(!empty($error)){
  $resp["Error"]          = $error;
}

echo json_encode($resp);
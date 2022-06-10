<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/CategoryFoodType/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/../../Data/CodeTables/CategoryFoodType/DistriXCodeTableFoodCategoryNameData.php");

include(__DIR__ . "/../../Data/Food/DistriXCodeTableLanguageData.php");
include(__DIR__ . "/../../Data/Food/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/Food/DistriXCodeTableNutritionalNameData.php");
include(__DIR__ . "/../../Data/Food/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../Data/Food/DistriXCodeTableWeightTypeNameData.php");

include(__DIR__ . "/../../Data/Food/DistriXFoodFoodData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodBrandData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodLabelData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodNutritionalData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodEcoScoreData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodNovaScoreData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodNutriScoreData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodWeightData.php");

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

$infoProfil = DistriXStyAppInterface::getUserInformation();
$_POST['id'] = $infoProfil->getIdLanguage(); // NG 27-05-22 - until a solution is found
list($distriXCodeTableLanguageData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListFoods");
$servicesCaller->setServiceName("Food/Food/DistriXFoodListBusSvc.php");
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
<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/CategoryFoodType/DistriXCodeTableCategoryFoodTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/CategoryFoodType/DistriXCodeTableCategoryFoodTypeNameData.php");

include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalNameData.php");
include(__DIR__ . "/../../Data/CodeTables/WeightType/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/WeightType/DistriXCodeTableWeightTypeNameData.php");

include(__DIR__ . "/../../Data/Food/DistriXFoodFoodData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodBrandData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodLabelData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodNutritionalData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodEcoScoreData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodNovaScoreData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodNutriScoreData.php");
include(__DIR__ . "/../../Data/Food/DistriXFoodWeightData.php");

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

// CALL
$foodCaller = new DistriXServicesCaller();
$foodCaller->setServiceName("Food/Food/DistriXFoodListDataSvc.php");
$foodCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);

$brandCaller = new DistriXServicesCaller();
$brandCaller->setServiceName("Food/Brand/DistriXFoodBrandListDataSvc.php");

$labelCaller = new DistriXServicesCaller();
$labelCaller->setServiceName("Food/Label/DistriXFoodLabelListDataSvc.php");

$ecoScoreCaller = new DistriXServicesCaller();
$ecoScoreCaller->setServiceName("Food/EcoScore/DistriXFoodEcoScoreListDataSvc.php");

$novaScoreCaller = new DistriXServicesCaller();
$novaScoreCaller->setServiceName("Food/NovaScore/DistriXFoodNovaScoreListDataSvc.php");

$nutriScoreCaller = new DistriXServicesCaller();
$nutriScoreCaller->setServiceName("Food/NutriScore/DistriXFoodNutriScoreListDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("food", $foodCaller);
$svc->addToCall("brand", $brandCaller);
$svc->addToCall("label", $labelCaller);
$svc->addToCall("ecoScore", $ecoScoreCaller);
$svc->addToCall("novaScore", $novaScoreCaller);
$svc->addToCall("nutriScore", $nutriScoreCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("food"); //print_r($output);
if ($outputok && isset($output["ListFoods"]) && is_array($output["ListFoods"])) {
  list($listFoods, $jsonError) = DistriXFoodFoodData::getJsonArray($output["ListFoods"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("food"); //print_r($output);
if ($outputok && isset($output["ListBrands"]) && is_array($output["ListBrands"])) {
  list($listBrands, $jsonError) = DistriXFoodBrandData::getJsonArray($output["ListBrands"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("food"); //print_r($output);
if ($outputok && isset($output["ListLabels"]) && is_array($output["ListLabels"])) {
  list($listLabels, $jsonError) = DistriXFoodLabelData::getJsonArray($output["ListLabels"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("food"); //print_r($output);
if ($outputok && isset($output["ListEcoScores"]) && is_array($output["ListEcoScores"])) {
  list($listEcoScores, $jsonError) = DistriXFoodEcoScoreData::getJsonArray($output["ListEcoScores"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("food"); //print_r($output);
if ($outputok && isset($output["ListNovaScores"]) && is_array($output["ListNovaScores"])) {
  list($listNovaScores, $jsonError) = DistriXFoodNovaScoreData::getJsonArray($output["ListNovaScores"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("food"); //print_r($output);
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
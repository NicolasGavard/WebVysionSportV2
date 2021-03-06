<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../Data/DistriXFoodFoodData.php");

include(__DIR__ . "/../../../CodeTables/Language/Data/DistriXCodeTableLanguageData.php");
include(__DIR__ . "/../../../Food/Brand/Data/DistriXFoodBrandData.php");
include(__DIR__ . "/../../../Food/EcoScore/Data/DistriXFoodEcoScoreData.php");
include(__DIR__ . "/../../../Food/NovaScore/Data/DistriXFoodNovaScoreData.php");
include(__DIR__ . "/../../../Food/NutriScore/Data/DistriXFoodNutriScoreData.php");

$resp               = [];
$listFoodFormFront  = [];
$listFoods          = [];
$listBrands         = [];
$listEcoScores      = [];
$listNovaScores     = [];
$listNutriScores    = [];

$servicesCaller     = new DistriXServicesCaller();

$infoProfil = DistriXStyAppInterface::getUserInformation();
$_POST['id'] = $infoProfil->getIdLanguage(); // NG 27-05-22 - until a solution is found
list($distriXCodeTableLanguageData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);

// CALL
$foodCaller = new DistriXServicesCaller();
$foodCaller->setServiceName("App/Food/Food/Services/DistriXFoodListDataSvc.php");
$foodCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);

$brandCaller = new DistriXServicesCaller();
$brandCaller->setServiceName("App/Food/Brand/Services/DistriXFoodBrandListDataSvc.php");

$ecoScoreCaller = new DistriXServicesCaller();
$ecoScoreCaller->setServiceName("App/Food/EcoScore/Services/DistriXFoodEcoScoreListDataSvc.php");

$novaScoreCaller = new DistriXServicesCaller();
$novaScoreCaller->setServiceName("App/Food/NovaScore/Services/DistriXFoodNovaScoreListDataSvc.php");

$nutriScoreCaller = new DistriXServicesCaller();
$nutriScoreCaller->setServiceName("App/Food/NutriScore/Services/DistriXFoodNutriScoreListDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("food", $foodCaller);
$svc->addToCall("brand", $brandCaller);
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

list($outputok, $output, $errorData) = $svc->getResult("brand"); //print_r($output);
if ($outputok && isset($output["ListBrands"]) && is_array($output["ListBrands"])) {
  list($listBrands, $jsonError) = DistriXFoodBrandData::getJsonArray($output["ListBrands"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("ecoScore"); //print_r($output);
if ($outputok && isset($output["ListEcoScores"]) && is_array($output["ListEcoScores"])) {
  list($listEcoScores, $jsonError) = DistriXFoodEcoScoreData::getJsonArray($output["ListEcoScores"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("novaScore"); //print_r($output);
if ($outputok && isset($output["ListNovaScores"]) && is_array($output["ListNovaScores"])) {
  list($listNovaScores, $jsonError) = DistriXFoodNovaScoreData::getJsonArray($output["ListNovaScores"]);
} else {
  $resp["Error"]      = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("nutriScore"); //print_r($output);
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
  $distriXFoodFoodData->setQrCode($food->getQrCode());
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
$resp["ListEcoScores"]    = $listEcoScores;
$resp["ListNovaScores"]   = $listNovaScores;
$resp["ListNutriScores"]  = $listNutriScores;

if(!empty($error)){
  $resp["Error"]          = $error;
}

echo json_encode($resp);
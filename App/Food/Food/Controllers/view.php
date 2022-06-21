<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");

include(__DIR__ . "/../Data/Food/DistriXFoodFoodData.php");
include(__DIR__ . "/../Data/Food/DistriXFoodBrandData.php");
include(__DIR__ . "/../Data/Food/DistriXFoodEcoScoreData.php");
include(__DIR__ . "/../Data/Food/DistriXFoodNovaScoreData.php");
include(__DIR__ . "/../Data/Food/DistriXFoodNutriScoreData.php");

$food             = new DistriXFoodFoodData();
$listBrands       = [];
$listEcoScores    = [];
$listNovaScores   = [];
$listNutriScores  = [];

$infoProfil = DistriXStyAppInterface::getUserInformation();
$_POST['id'] = $infoProfil->getIdLanguage(); // NG 27-05-22 - until a solution is found
list($distriXCodeTableLanguageData, $errorJson) = DistriXCodeTableLanguageData::getJsonData($_POST);

if (isset($_POST['idFood'])) {$_POST['id'] = $_POST['idFood'];}
list($distriXFoodFoodData, $errorJson) = DistriXFoodFoodData::getJsonData($_POST);

$foodCaller = new DistriXServicesCaller();
$foodCaller->setServiceName("Food/Food/DistriXFoodViewDataSvc.php");
$foodCaller->addParameter("data", $distriXFoodFoodData);
$foodCaller->addParameter("dataLanguage", $distriXCodeTableLanguageData);

$brandCaller = new DistriXServicesCaller();
$brandCaller->setServiceName("Food/Brand/DistriXFoodBrandListDataSvc.php");

$ecoScoreCaller = new DistriXServicesCaller();
$ecoScoreCaller->setServiceName("Food/EcoScore/DistriXFoodEcoScoreListDataSvc.php");

$novaScoreCaller = new DistriXServicesCaller();
$novaScoreCaller->setServiceName("Food/NovaScore/DistriXFoodNovaScoreListDataSvc.php");

$nutriScoreCaller = new DistriXServicesCaller();
$nutriScoreCaller->setServiceName("Food/NutriScore/DistriXFoodNutriScoreListDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("food", $foodCaller);
$svc->addToCall("brand", $brandCaller);
$svc->addToCall("ecoScore", $ecoScoreCaller);
$svc->addToCall("novaScore", $novaScoreCaller);
$svc->addToCall("nutriScore", $nutriScoreCaller);
$callsOk = $svc->call();

list($outputok, $output, $errorData) = $svc->getResult("food"); //print_r($output);
if ($outputok && isset($output["ViewFood"]) && is_array($output["ViewFood"])) {
  list($food, $jsonError) = DistriXFoodFoodData::getJsonData($output["ViewFood"]);
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
  }
}

foreach ($listEcoScores as $ecoScore) {
  if ($food->getidScoreEco() == $ecoScore->getId()) {
    $distriXFoodFoodData->setNameScoreEco($ecoScore->getLetter());
  }
}

foreach ($listNovaScores as $novaScore) {
  if ($food->getIdScoreNova() == $novaScore->getId()) {
    $distriXFoodFoodData->setNameScoreNova($novaScore->getNumber());
  }
}

foreach ($listNutriScores as $nutriScore) {
  if ($food->getIdScoreNutri() == $nutriScore->getId()) {
    $distriXFoodFoodData->setNameScoreNutri($nutriScore->getLetter());
  }
}

$resp["ViewFood"]  = $distriXFoodFoodData;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
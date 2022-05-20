<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// DATA GENERAL
include(__DIR__ . "/../../Data/DistriXGeneralIdData.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../Data/DistriXFoodFoodData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableFoodCategoryNameData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableNutritionalNameData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableWeightTypeNameData.php");
include(__DIR__ . "/../../Data/DistriXFoodBrandData.php");
include(__DIR__ . "/../../Data/DistriXFoodLabelData.php");
include(__DIR__ . "/../../Data/DistriXFoodNutritionalData.php");
include(__DIR__ . "/../../Data/DistriXFoodScoreEcoData.php");
include(__DIR__ . "/../../Data/DistriXFoodScoreNovaData.php");
include(__DIR__ . "/../../Data/DistriXFoodScoreNutriData.php");
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
$resp             = array();
$listFoods        = array();
$listBrands       = array();
$listLabels       = array();
$listScoresEco    = array();
$listScoresNova   = array();
$listScoresNutri  = array();

$error            = array();
$output           = array();
$outputok         = false;
$servicesCaller   = new DistriXServicesCaller();

$listLanguages        = DistriXStyLanguage::listLanguages();
$infoProfil           = DistriXStyAppInterface::getUserInformation();
$distriXGeneralIdData = new DistriXGeneralIdData();
$distriXGeneralIdData->setId($infoProfil->getIdLanguage());

$infoProfil           = DistriXStyAppInterface::getUserInformation();
$distriXGeneralIdData = new DistriXGeneralIdData();
$distriXGeneralIdData->setId($infoProfil->getIdLanguage());

$distriXFoodFoodData = new DistriXFoodFoodData();
$distriXFoodFoodData->setIdBrand($_POST['idBrand']);
$distriXFoodFoodData->setIdScoreNutri($_POST['idScoreNutri']);
$distriXFoodFoodData->setIdScoreNova($_POST['idScoreNova']);
$distriXFoodFoodData->setIdScoreEco($_POST['idScoreEco']);

$servicesCaller->setServiceName("DistriXServices/Food/Food/DistriXFoodListDataSvc.php");
$servicesCaller->setMethodName("ListFoods");
$servicesCaller->addParameter("dataLanguage", $distriXGeneralIdData);
$servicesCaller->addParameter("dataFood", $distriXFoodFoodData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListFoods"])) {
    $listFoods = $output["ListFoods"];
  }
} else {
  $error = $errorData;
}

$servicesCaller->setMethodName("ListWeightType");
$servicesCaller->addParameter("dataLanguage", $distriXGeneralIdData);
$servicesCaller->setServiceName("DistriXServices/TablesCodes/WeightType/DistriXWeightTypeListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListWeightType"])) {
    $listWeightType = $output["ListWeightType"];
  }
} else {
  $error = $errorData;
}

$servicesCaller->setServiceName("DistriXServices/Food/Brand/DistriXFoodBrandListDataSvc.php");
$servicesCaller->setMethodName("ListBrands");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListBrands"])) {
    $listBrands = $output["ListBrands"];
  }
} else {
  $error = $errorData;
}

$servicesCaller->setServiceName("DistriXServices/Food/Label/DistriXFoodLabelListDataSvc.php");
$servicesCaller->setMethodName("ListLabels");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListLabels"])) {
    $listLabels = $output["ListLabels"];
  }
} else {
  $error = $errorData;
}

$servicesCaller->setServiceName("DistriXServices/Food/ScoreEco/DistriXFoodScoreEcoListDataSvc.php");
$servicesCaller->setMethodName("ListScoresEco");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListScoresEco"])) {
    $listScoresEco = $output["ListScoresEco"];
  }
} else {
  $error = $errorData;
}

$servicesCaller->setServiceName("DistriXServices/Food/ScoreNova/DistriXFoodScoreNovaListDataSvc.php");
$servicesCaller->setMethodName("ListScoresNova");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListScoresNova"])) {
    $listScoresNova = $output["ListScoresNova"];
  }
} else {
  $error = $errorData;
}

$servicesCaller->setMethodName("ListScoresNutri");
$servicesCaller->setServiceName("DistriXServices/Food/ScoreNutri/DistriXFoodScoreNutriListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListScoresNutri"])) {
    $listScoresNutri = $output["ListScoresNutri"];
  }
} else {
  $error = $errorData;
}

$resp["ListFoods"]        = $listFoods;
$resp["ListBrands"]       = $listBrands;
$resp["ListLabels"]       = $listLabels;
$resp["ListScoresEco"]    = $listScoresEco;
$resp["ListScoresNova"]   = $listScoresNova;
$resp["ListScoresNutri"]  = $listScoresNutri;
$resp["ListWeightType"]   = $listWeightType;

if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
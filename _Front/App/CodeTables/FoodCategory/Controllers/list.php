<?php session_start();
include(__DIR__ . "/../../../DistriXSvc/Config/DistriXFolderPath.php");
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/FoodCategory/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/../../Data/CodeTables/FoodCategory/DistriXCodeTableFoodCategoryNameData.php");
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp               = [];
$listFoodCategories = [];
$listLanguages      = [];
$error              = [];
$output             = [];
$outputok           = false;

// CALL
$languageCaller = new DistriXServicesCaller();
$languageCaller->setMethodName("ListLanguages");
$languageCaller->setServiceName("TablesCodes/Language/DistriXLanguageListDataSvc.php");

$infoProfil = DistriXStyAppInterface::getUserInformation();
$dataName = new DistriXCodeTableFoodCategoryNameData();
$dataName->setIdLanguage($infoProfil->getIdLanguage());

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("dataName", $dataName);
$servicesCaller->setServiceName("TablesCodes/FoodCategory/DistriXFoodCategoryListDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("Language", $languageCaller);
$svc->addToCall("FoodCategory", $servicesCaller);
$callsOk = $svc->call();

// RESPONSES
list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
  list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("FoodCategory"); print_r($output);
if ($outputok && isset($output["ListFoodCategories"]) && is_array($output["ListFoodCategories"])) {
  list($listFoodCategories, $jsonError) = DistriXCodeTableFoodCategoryData::getJsonArray($output["ListFoodCategories"]);
} else {
  $error = $errorData;
}
if ($outputok && isset($output["ListFoodCategoryNames"]) && is_array($output["ListFoodCategoryNames"])) {
  list($listFoodCategoryNames, $jsonError) = DistriXCodeTableFoodCategoryNameData::getJsonArray($output["ListFoodCategoryNames"]);
} else {
  $error = $errorData;
}

// TREATMENT
$nbLanguagesTotal = count($listLanguages);
foreach ($listFoodCategories as $foodCategory) {
  $foodCategory->setNbLanguagesTotal($nbLanguagesTotal);
  $names = [];
  foreach ($listFoodCategoryNames as $foodCategoryName) {
    if ($foodCategoryName->getIdFoodCategory() == $foodCategory->getId()) {
      $names[] = $foodCategoryName;
    }
  }
  $foodCategory->setNames($names);
  $foodCategory->setNbLanguages(count($names));
}

$resp["ListFoodCategories"] = $listFoodCategories;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}

echo json_encode($resp);
<?php session_start();
include(__DIR__ . "/../../../DistriXSvc/Config/DistriXFolderPath.php");
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/FoodType/DistriXCodeTableFoodTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/FoodType/DistriXCodeTableFoodTypeNameData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableLanguageData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp          = [];
$listFoodTypes = [];
$listLanguages = [];
$error         = [];
$output        = [];
$outputok      = false;

// CALL
$languageCaller = new DistriXServicesCaller();
$languageCaller->setMethodName("ListLanguages");
$languageCaller->setServiceName("TablesCodes/Language/DistriXLanguageListDataSvc.php");

$dataName = new DistriXCodeTableFoodTypeNameData();
// $dataName->setIdLanguage(1);
// $dataName->setIdLanguage(2);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("dataName", $dataName);
$servicesCaller->setServiceName("TablesCodes/FoodType/DistriXFoodTypeListDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("Language", $languageCaller);
$svc->addToCall("FoodType", $servicesCaller);
$callsOk = $svc->call();

// RESPONSES
list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
  list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
} else {
  $error = $errorData;
}
list($outputok, $output, $errorData) = $svc->getResult("FoodType"); //print_r($output);
if ($outputok && isset($output["ListFoodTypes"]) && is_array($output["ListFoodTypes"])) {
  list($listFoodTypes, $jsonError) = DistriXCodeTableFoodTypeData::getJsonArray($output["ListFoodTypes"]);
} else {
  $error = $errorData;
}
if ($outputok && isset($output["ListFoodTypeNames"]) && is_array($output["ListFoodTypeNames"])) {
  list($listFoodTypeNames, $jsonError) = DistriXCodeTableFoodTypeNameData::getJsonArray($output["ListFoodTypeNames"]);
} else {
  $error = $errorData;
}

// TREATMENT
$nbLanguagesTotal = count($listLanguages);
foreach ($listFoodTypes as $foodType) {
  $foodType->setNbLanguagesTotal($nbLanguagesTotal);
  $names = [];
  foreach ($listFoodTypeNames as $foodTypeName) {
    if ($foodTypeName->getIdFoodType() == $foodType->getId()) {
      $names[] = $foodTypeName;
    }
  }
  $foodType->setNames($names);
  $foodType->setNbLanguages(count($names));
}

$resp["ListFoodTypes"] = $listFoodTypes;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}

echo json_encode($resp);
<?php session_start();
include(__DIR__ . "/../../../DistriXSvc/Config/DistriXFolderPath.php");
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/MealType/DistriXCodeTableMealTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/MealType/DistriXCodeTableMealTypeNameData.php");
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp          = [];
$listMealTypes = [];
$listLanguages = [];
$error         = [];
$output        = [];
$outputok      = false;

// CALL
$languageCaller = new DistriXServicesCaller();
$languageCaller->setMethodName("ListLanguages");
$languageCaller->setServiceName("TablesCodes/Language/DistriXLanguageListDataSvc.php");

$infoProfil = DistriXStyAppInterface::getUserInformation();
$dataName   = new DistriXCodeTableMealTypeNameData();
$dataName->setIdLanguage($infoProfil->getIdLanguage());

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("dataName", $dataName);
$servicesCaller->setServiceName("TablesCodes/MealType/DistriXMealTypeListDataSvc.php");

$svc = new DistriXSvc();
$svc->addToCall("Language", $languageCaller);
$svc->addToCall("MealType", $servicesCaller);
$callsOk = $svc->call();

// RESPONSES
list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
  list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
} else {
  $error = $errorData;
}

list($outputok, $output, $errorData) = $svc->getResult("MealType"); print_r($output);
if ($outputok && isset($output["ListMealTypes"]) && is_array($output["ListMealTypes"])) {
  list($listMealTypes, $jsonError) = DistriXCodeTableMealTypeData::getJsonArray($output["ListMealTypes"]);
} else {
  $error = $errorData;
}

if ($outputok && isset($output["ListMealTypeNames"]) && is_array($output["ListMealTypeNames"])) {
  list($listMealTypeNames, $jsonError) = DistriXCodeTableMealTypeNameData::getJsonArray($output["ListMealTypeNames"]);
} else {
  $error = $errorData;
}

// TREATMENT
$nbLanguagesTotal = count($listLanguages);
foreach ($listMealTypes as $foodType) {
  $foodType->setNbLanguagesTotal($nbLanguagesTotal);
  $names = [];
  foreach ($listMealTypeNames as $foodTypeName) {
    if ($foodTypeName->getIdMealType() == $foodType->getId()) {
      $names[] = $foodTypeName;
    }
  }
  $foodType->setNames($names);
  $foodType->setNbLanguages(count($names));
}

$resp["ListMealTypes"] = $listMealTypes;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}

echo json_encode($resp);
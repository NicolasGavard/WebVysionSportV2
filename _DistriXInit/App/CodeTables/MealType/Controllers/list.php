<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableMealTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableMealTypeNameData.php");
include(__DIR__ . "/../../Language/Data/DistriXCodeTableLanguageData.php");

$listMealTypes = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");

  $dataName       = new DistriXCodeTableMealTypeNameData();
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("App/CodeTables/MealType/Services/DistriXMealTypeListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("MealType", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_MealType", "DistriXMealTypeListDataSvc", "ListMealType-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("MealType"); //print_r($output);
  $logOk = logController("Security_MealType", "DistriXMealTypeListDataSvc", "ListMealType-MealTypes", $output);
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
  foreach ($listMealTypes as $mealType) {
    $mealType->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listMealTypeNames as $mealTypeName) {
      if ($mealTypeName->getIdMealType() == $mealType->getId()) {
        $names[] = $mealTypeName;
      }
    }
    $mealType->setNames($names);
    $mealType->setNbLanguages(count($names));
  }
}
$resp["ListMealTypes"] = $listMealTypes;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

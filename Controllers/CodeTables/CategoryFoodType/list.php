<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/CategoryFoodType/DistriXCodeTableCategoryFoodTypeData.php");
include(__DIR__ . "/../../Data/CodeTables/CategoryFoodType/DistriXCodeTableCategoryFoodTypeNameData.php");
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");

$listCategoryFoodTypes = [];
$listLanguages = [];

// TESTS
//$_POST["idLanguage"] = 1;
//$_POST["idLanguage"] = 2;

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("TablesCodes/Language/DistriXLanguageListDataSvc.php");

  list($dataName, $errorJson) = DistriXCodeTableCategoryFoodTypeNameData::getJsonData($_POST);

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("TablesCodes/CategoryFoodType/DistriXCategoryFoodTypeListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("CategoryFoodType", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_CategoryFoodType", "DistriXCategoryFoodTypeListDataSvc", "ListCategoryFoodType-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }
  list($outputok, $output, $errorData) = $svc->getResult("CategoryFoodType"); //print_r($output);
  $logOk = logController("Security_CategoryFoodType", "DistriXCategoryFoodTypeListDataSvc", "ListCategoryFoodType-CategoryFoodTypes", $output);
  if ($outputok && isset($output["ListCategoryFoodTypes"]) && is_array($output["ListCategoryFoodTypes"])) {
    list($listCategoryFoodTypes, $jsonError) = DistriXCodeTableCategoryFoodTypeData::getJsonArray($output["ListCategoryFoodTypes"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ListCategoryFoodTypeNames"]) && is_array($output["ListCategoryFoodTypeNames"])) {
    list($listCategoryFoodTypeNames, $jsonError) = DistriXCodeTableCategoryFoodTypeNameData::getJsonArray($output["ListCategoryFoodTypeNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $nbLanguagesTotal = count($listLanguages);
  foreach ($listCategoryFoodTypes as $foodType) {
    $foodType->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listCategoryFoodTypeNames as $foodTypeName) {
      if ($foodTypeName->getIdCategoryFoodType() == $foodType->getId()) {
        $names[] = $foodTypeName;
      }
    }
    $foodType->setNames($names);
    $foodType->setNbLanguages(count($names));
  }
}
$resp["ListCategoryFoodTypes"] = $listCategoryFoodTypes;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableCategoryFoodTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableCategoryFoodTypeNameData.php");
include(__DIR__ . "/../../Language/Data/DistriXCodeTableLanguageData.php");

$listCategoryFoodTypes = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");

  $dataName       = new DistriXCodeTableCategoryFoodTypeNameData();
  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("App/CodeTables/CategoryFoodType/Services/DistriXCategoryFoodTypeListDataSvc.php");

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

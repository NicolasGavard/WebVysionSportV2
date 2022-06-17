<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../Data/DistriXCodeTableFoodTypeData.php");
include(__DIR__ . "/../Data/DistriXCodeTableFoodTypeNameData.php");
include(__DIR__ . "/../../Language/Data/DistriXCodeTableLanguageData.php");

$listFoodTypes = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("App/CodeTables/Language/Services/DistriXLanguageListDataSvc.php");

  // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  // Pas de langue pour avoir toutes les langues ! 10-June-22
  // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  $dataName = new DistriXCodeTableFoodTypeNameData();

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("App/CodeTables/FoodType/Services/DistriXFoodTypeListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("FoodType", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_FoodType", "DistriXFoodTypeListDataSvc", "ListFoodType-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }
  list($outputok, $output, $errorData) = $svc->getResult("FoodType"); //print_r($output);
  $logOk = logController("Security_FoodType", "DistriXFoodTypeListDataSvc", "ListFoodType-FoodTypes", $output);
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
}
$resp["ListFoodTypes"] = $listFoodTypes;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

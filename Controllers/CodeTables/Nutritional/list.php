<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/../../Data/CodeTables/Nutritional/DistriXCodeTableNutritionalNameData.php");
include(__DIR__ . "/../../Data/CodeTables/Language/DistriXCodeTableLanguageData.php");

$listNutritionals = [];
$listLanguages = [];

if (isset($_POST)) {
// CALL
  $languageCaller = new DistriXServicesCaller();
  $languageCaller->setMethodName("ListLanguages");
  $languageCaller->setServiceName("TablesCodes/Language/DistriXLanguageListDataSvc.php");

  // $infoProfil = DistriXStyAppInterface::getUserInformation();
  // if (empty($_POST['idLanguage'])) {
  //   $_POST['idLanguage'] = $infoProfil->getIdLanguage();
  // }
  // list($dataName, $errorJson) = DistriXCodeTableNutritionalNameData::getJsonData($_POST);

  // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  // Pas de langue pour avoir toutes les langues ! Dev2 10-June-22
  // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  $dataName = new DistriXCodeTableNutritionalNameData();

  $servicesCaller = new DistriXServicesCaller();
  $servicesCaller->addParameter("dataName", $dataName);
  $servicesCaller->setServiceName("TablesCodes/Nutritional/DistriXNutritionalListDataSvc.php");

  $svc = new DistriXSvc();
  $svc->addToCall("Language", $languageCaller);
  $svc->addToCall("Nutritional", $servicesCaller);
  $callsOk = $svc->call();

// RESPONSES
  list($outputok, $output, $errorData) = $svc->getResult("Language"); //print_r($output);
  $logOk = logController("Security_Nutritional", "DistriXNutritionalListDataSvc", "ListNutritional-Languages", $output);
  if ($outputok && isset($output["ListLanguages"]) && is_array($output["ListLanguages"])) {
    list($listLanguages, $jsonError) = DistriXCodeTableLanguageData::getJsonArray($output["ListLanguages"]);
  } else {
    $error = $errorData;
  }
  list($outputok, $output, $errorData) = $svc->getResult("Nutritional"); //print_r($output);
  $logOk = logController("Security_Nutritional", "DistriXNutritionalListDataSvc", "ListNutritional-Nutritionals", $output);
  if ($outputok && isset($output["ListNutritionals"]) && is_array($output["ListNutritionals"])) {
    list($listNutritionals, $jsonError) = DistriXCodeTableNutritionalData::getJsonArray($output["ListNutritionals"]);
  } else {
    $error = $errorData;
  }
  if ($outputok && isset($output["ListNutritionalNames"]) && is_array($output["ListNutritionalNames"])) {
    list($listNutritionalNames, $jsonError) = DistriXCodeTableNutritionalNameData::getJsonArray($output["ListNutritionalNames"]);
  } else {
    $error = $errorData;
  }

// TREATMENT
  $nbLanguagesTotal = count($listLanguages);
  foreach ($listNutritionals as $nutritional) {
    $nutritional->setNbLanguagesTotal($nbLanguagesTotal);
    $names = [];
    foreach ($listNutritionalNames as $nutritionalName) {
      if ($nutritionalName->getIdNutritional() == $nutritional->getId()) {
        $names[] = $nutritionalName;
      }
    }
    $nutritional->setNames($names);
    $nutritional->setNbLanguages(count($names));
  }
}
$resp["ListNutritionals"] = $listNutritionals;
$resp["ListLanguages"] = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}
echo json_encode($resp);

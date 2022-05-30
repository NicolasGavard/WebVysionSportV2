<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcBusServiceInit.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/DietStorData.php");
include(__DIR__ . "/Data/DietTemplateStorData.php");
include(__DIR__ . "/Data/DietStudentStorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListMyCurrentsDiets");
$servicesCaller->setServiceName("DistriXServices/Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$servicesCaller->addParameter("data", $busSvc->getParameter("data"));
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);
// Current Diet
if ($outputok && isset($output["ListMyCurrentsDiets"]) && is_array($output["ListMyCurrentsDiets"])) {
  $listMyCurrentDiets = $output["ListMyCurrentsDiets"];

  $myTemplateDietsCaller = new DistriXServicesCaller();
  $myTemplateDietsCaller->setMethodName("ListMyTemplatesDiets");
  $myTemplateDietsCaller->addParameter("data", $listMyCurrentDiets);
  $myTemplateDietsCaller->setServiceName("DistriXServices/Nutrition/TemplateDiet/DistriXNutritionMyTemplatesDietsListDataSvc.php");
  
  $myStudentDietsCaller = new DistriXServicesCaller();
  $myStudentDietsCaller->setMethodName("ListMyStudentsDiets");
  $myStudentDietsCaller->addParameter("data", $listMyCurrentDiets);
  $myStudentDietsCaller->setServiceName("DistriXServices/Nutrition/StudentDiet/DistriXNutritionMyStudentsDietsListDataSvc.php");
  
  // Add Caller to multi caller
  $svc = new DistriXSvc();
  $svc->addToCall("TemplateDiets", $myTemplateDietsCaller);
  $svc->addToCall("StudentDiets", $myStudentDietsCaller);
  
  $listMyTemplateDiets  = [];
  $listMyStudentDiets   = [];
  
  list($outputok, $output, $errorData) = $svc->getResult("TemplateDiets"); var_dump($output);
  if ($outputok && isset($output["ListTemplateDiets"]) && is_array($output["ListTemplateDiets"])) {
    list($listMyTemplateDiets, $jsonError) = DietTemplateStorData::getJsonArray($output["ListTemplateDiets"]);
  } else {
    $error = $errorData;
  }
  
  list($outputok, $output, $errorData) = $svc->getResult("StudentDiets"); var_dump($output);
  if ($outputok && isset($output["ListStudentDiets"]) && is_array($output["ListStudentDiets"])) {
    list($listMyStudentDiets, $jsonError) = DietStudentStorData::getJsonArray($output["ListStudentDiets"]);
  } else {
    $error = $errorData;
  }
} else {
  $error = $errorData;
}

$busSvc->addToResponse("ListMyCurrentsDiets", $listMyCurrentDiets);
$busSvc->addToResponse("ListMyTemplatesDiets", $listMyTemplateDiets);
$busSvc->addToResponse("ListMyStudentsDiets", $listMyStudentDiets);

$busSvc->endOfService();
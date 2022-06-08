<?php
session_start();
include(__DIR__ . "/../../Init/ControllerInit.php");
// DATA
include(__DIR__ . "/../../Data/Nutrition/MyTemplatesDiets/DistriXNutritionTemplateDietData.php");

$label  = new DistriXNutritionTemplatetDietData();
if ($_POST['id'] > 0) {
  $label->setId($_POST['id']);
}

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ViewMyTemplatetDiet");
$servicesCaller->addParameter("data", $label);
$servicesCaller->setServiceName("Food/MyTemplatetDiet/DistriXFoodMyTemplatetDietViewDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

$logOk = logController("Security_CurrentDiet", "DistriXMyTemplatetDietViewDataSvc", "ViewMyTemplatetDiet", $output);

if ($outputok && !empty($output) > 0) {
  if (isset($output["ViewMyTemplatetDiet"])) {
    $label = $output["ViewMyTemplatetDiet"];
  }
} else {
  $error = $errorData;
}

$resp["ViewMyTemplatetDiet"]  = $label;
if(!empty($error)){
  $resp["Error"]    = $error;
}

echo json_encode($resp);
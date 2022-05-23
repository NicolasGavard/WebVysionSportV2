<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../Data/DistriXNutritionCurrentDietData.php");
include(__DIR__ . "/../../Data/DistriXNutritionCurrentDietUsersData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp               = array();
$listMyCurrentDiets = array();
$error              = array();
$output             = array();
$outputok           = false;

$distriXNutritionCurrentDietData = new DistriXNutritionCurrentDietData();
$distriXNutritionCurrentDietData->setIdUser($_POST['idUser']);
$distriXNutritionCurrentDietData->setStatus($_POST['status']);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListMyCurrentsDiets");
$servicesCaller->setServiceName("DistriXServices/Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListDataSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionCurrentDietData);
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);
if ($outputok && !empty($output) > 0) {
  if (isset($output["ListMyCurrentsDiets"])) {
    $listMyCurrentDiets = $output["ListMyCurrentsDiets"];
  }
} else {
  $error = $errorData;
}

$resp["ListMyCurrentsDiets"] = $listMyCurrentDiets;
if(!empty($error)){
  $resp["Error"]        = $error;
}

echo json_encode($resp);
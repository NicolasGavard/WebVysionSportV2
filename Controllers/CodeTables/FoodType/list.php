<?php session_start();
include(__DIR__ . "/../../../DistriXSvc/Config/DistriXFolderPath.php");
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
// include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/Data/DistriXCodeTableFoodTypeData.php");
include(__DIR__ . "/Data/DistriXCodeTableFoodTypeNameData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp          = [];
$listFoodTypes = [];
$error         = [];
$output        = [];
$outputok      = false;


$dataName = new DistriXCodeTableFoodTypeNameData();
// $dataName->setIdLanguage(1);
// $dataName->setIdLanguage(2);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->addParameter("dataName", $dataName);
$servicesCaller->setServiceName("DistriXServices/TablesCodes/FoodType/DistriXFoodTypeListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //print_r($output);

if ($outputok && isset($output["ListFoodTypes"]) && is_array($output["ListFoodTypes"])) {
  list($listFoodTypes, $jsonError) = DistriXCodeTableFoodTypeData::getJsonArray($output["ListFoodTypes"]);
} else {
  $error = $errorData;
}
if ($outputok && isset($output["ListFoodTypeNames"]) && is_array($output["ListFoodTypeNames"])) {
  list($listFoodTypeNames, $jsonError) = DistriXCodeTableFoodTypeNameData::getJsonArray($output["ListFoodTypeNames"]);
  foreach ($listFoodTypes as $foodType) {
    $names = [];
    foreach ($listFoodTypeNames as $foodTypeName) {
      if ($foodTypeName->getIdFoodType() == $foodType->getId()) {
        $names[] = $foodTypeName;
      }
    }
    $foodType->setNames($names);
  }
} else {
  $error = $errorData;
}

$resp["ListFoodTypes"] = $listFoodTypes;
if (!empty($error)) {
  $resp["Error"] = $error;
}

echo json_encode($resp);
<?php session_start();
include(__DIR__ . "/../../DistriXSvc/Config/DistriXFolderPath.php");


include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyLanguage.php");
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyLanguageData.php");
include(__DIR__ . "/../../Data/DistriXGeneralIdData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/../../Data/DistriXCodeTableFoodCategoryNameData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp             = [];
$listFoodCategory = [];
$error            = [];
$output           = [];
$outputok         = false;

$listLanguages    = DistriXStyLanguage::listLanguages();


$infoProfil           = DistriXStyAppInterface::getUserInformation();
$distriXGeneralIdData = new DistriXGeneralIdData();
$distriXGeneralIdData->setId($infoProfil->getIdLanguage());

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListFoodCategory");
$servicesCaller->addParameter("dataLanguage", $distriXGeneralIdData);
$servicesCaller->setServiceName("TablesCodes/FoodCategory/DistriXFoodCategoryListDataSvc.php");
list($outputok, $output, $errorData) = $servicesCaller->call(); //var_dump($output);

if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_FoodCategory")) {
  $logInfoData = new DistriXLoggerInfoData();
  $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
  $logInfoData->setLogApplication("DistriXFoodCategoryListDataSvc");
  $logInfoData->setLogFunction("ListFoodCategory");
  $logInfoData->setLogData(print_r($output, true));
  DistriXLogger::log($logInfoData);
}
if ($outputok && isset($busOutput["ListFoodCategory"]) && is_array($busOutput["ListFoodCategory"])) {
  list($resp["ListFoodCategory"], $jsonError) = DistriXCodeTableFoodCategoryData::getJsonArray($busOutput["ListFoodCategory"]);
} else {
  $error = $errorData;
}

$resp["ListFoodCategory"] = $listFoodCategory;
$resp["ListLanguages"]    = $listLanguages;
if (!empty($error)) {
  $resp["Error"] = $error;
}

echo json_encode($resp);
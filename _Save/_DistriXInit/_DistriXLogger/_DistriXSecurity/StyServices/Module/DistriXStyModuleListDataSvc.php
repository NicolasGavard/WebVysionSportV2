<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyModuleData.php");
// Database Data
include(__DIR__ . "/Data/StyApplicationStorData.php");
include(__DIR__ . "/Data/StyModuleStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyApplicationStor.php");
include(__DIR__ . "/Storage/StyModuleStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$modules = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  
  $data = $dataSvc->getParameter("data");
    
  if ($data->getIdStyApplication() == 0) {
    list($styModuleStor, $styModuleStorInd) = StyModuleStor::getList(true, $dbConnection);
  } else if ($data->getIdStyApplication() > 0) {
    $styModuleStorData = New StyModuleStorData();
    $styModuleStorData->setIdStyApplication($data->getIdStyApplication());
    list($styModuleStor, $styModuleStorInd) = StyModuleStor::findByIdStyApplication($styModuleStorData, true, $dbConnection);
  }
  
  foreach ($styModuleStor as $module) {
    $infoModule = DistriXSvcUtil::setData($module, "DistriXStyModuleData");
    
    $styApplicationStor = StyApplicationStor::read($module->getIdStyApplication(), $dbConnection);
    $infoModule->setCodeStyApplication($styApplicationStor->getCode());
    
    $modules[]  = $infoModule;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListModules", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListModules", $modules);

// Return response
$dataSvc->endOfService();

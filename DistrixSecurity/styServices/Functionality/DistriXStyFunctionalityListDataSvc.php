<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyFunctionalityData.php");
// Database Data
include(__DIR__ . "/Data/StyApplicationStorData.php");
include(__DIR__ . "/Data/StyModuleStorData.php");
include(__DIR__ . "/Data/StyFunctionalityStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyApplicationStor.php");
include(__DIR__ . "/Storage/StyModuleStor.php");
include(__DIR__ . "/Storage/StyFunctionalityStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$functionalities = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data = $dataSvc->getParameter("data");
  
  // Au début tous afficher
  if ($data->getIdStyApplication() == 0 && $data->getIdStyModule() == 0) {
    list($styModuleStor, $styModuleStorInd) = StyModuleStor::getList(true, $dbConnection);
  }

  // si filtre sur les modules
  if ($data->getIdStyModule() > 0) {
    $styFunctionalitystorData = new StyFunctionalitystorData();
    $styFunctionalitystorData->setIdStyModule($data->getIdStyModule());
    list($styFunctionalitystor, $styFunctionalitystorInd) = StyFunctionalityStor::findByIdStyModule($styFunctionalitystorData, true, $dbConnection);
    foreach ($styFunctionalitystor as $functionality) {
      $infoFunctionality  = DistriXSvcUtil::setData($functionality, "DistriXStyFunctionalityData");
      $styModuleStor      = StyModuleStor::read($functionality->getIdStyModule(), $dbConnection);
      $infoFunctionality->setCodeStyModule($styModuleStor->getCode());
      
      $styApplicationStor = StyApplicationStor::read($styModuleStor->getIdStyApplication(), $dbConnection);
      $infoFunctionality->setIdStyApplication($styApplicationStor->getId());
      $infoFunctionality->setCodeStyApplication($styApplicationStor->getCode());
      $functionalities[]  = $infoFunctionality;
    }
  }

  // si filtre sur les applications
  if ($data->getIdStyApplication() > 0 && $data->getIdStyModule() == 0) {
    $styModuleStorData = New StyModuleStorData();
    $styModuleStorData->setIdStyApplication($data->getIdStyApplication());
    list($styModuleStor, $styModuleStorInd) = StyModuleStor::findByIdStyApplication($styModuleStorData, true, $dbConnection);
    foreach ($styModuleStor as $module) {
      $styFunctionalitystorData = new StyFunctionalitystorData();
      $styFunctionalitystorData->setIdStyModule($module->getId());
      list($styFunctionalitystor, $styFunctionalitystorInd) = StyFunctionalityStor::findByIdStyModule($styFunctionalitystorData, true, $dbConnection);
      foreach ($styFunctionalitystor as $functionality) {
        $infoFunctionality  = DistriXSvcUtil::setData($functionality, "DistriXStyFunctionalityData");
        $styModuleStor      = StyModuleStor::read($functionality->getIdStyModule(), $dbConnection);
        $infoFunctionality->setCodeStyModule($styModuleStor->getCode());
        
        $styApplicationStor = StyApplicationStor::read($styModuleStor->getIdStyApplication(), $dbConnection);
        $infoFunctionality->setIdStyApplication($styApplicationStor->getId());
        $infoFunctionality->setCodeStyApplication($styApplicationStor->getCode());
        $functionalities[]  = $infoFunctionality;
      }
    }
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListFunctionalities", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListFunctionalities", $functionalities);

// Return response
$dataSvc->endOfService();

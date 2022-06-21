<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
include(__DIR__ . "/../../Const/DistriXStyRightConst.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyRoleRightsData.php");
include(__DIR__ . "/../../Data/DistriXStyRoleRightData.php");
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyModuleData.php");
include(__DIR__ . "/../../Data/DistriXStyFunctionalityData.php");
include(__DIR__ . "/../../Data/DistriXStyRoleData.php");
include(__DIR__ . "/../../Data/DistriXStyRightData.php");
// Database Data
include(__DIR__ . "/Data/StyApplicationStorData.php");
include(__DIR__ . "/Data/StyFunctionalityStorData.php");
include(__DIR__ . "/Data/StyModuleStorData.php");
include(__DIR__ . "/Data/StyRoleRightStorData.php");
include(__DIR__ . "/Data/StyRoleStorData.php");
include(__DIR__ . "/Data/StyRightStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyApplicationStor.php");
include(__DIR__ . "/Storage/StyFunctionalityStor.php");
include(__DIR__ . "/Storage/StyModuleStor.php");
include(__DIR__ . "/Storage/StyRoleRightStor.php");
include(__DIR__ . "/Storage/StyRoleStor.php");
include(__DIR__ . "/Storage/StyRightStor.php");
$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$roleRights   = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $distriXStyRoleRightData  = new DistriXStyRoleRightsData();
  $data                     = $dataSvc->getParameter("data");
  $styRoleRightsData        = DistriXSvcUtil::setData($data, "StyRoleRightStorData");
  list($styRoleRightStorData, $styRoleRightStorDataInd) = StyRoleRightStor::findByIndRoleGroupBy($styRoleRightsData, $dbConnection);
  foreach ($styRoleRightStorData as $roleRight) {
    $styRoleAppStorData     = StyRoleStor::read($roleRight->getIdStyRole(), $dbConnection);
    $distriXStyRoleRightData->setIdStyRole($styRoleAppStorData->getId());
    $distriXStyRoleRightData->setCodeRole($styRoleAppStorData->getCode());
    $distriXStyRoleRightData->setNameRole($styRoleAppStorData->getName());

    $roleApplications           = [];
    $styRoleRightStorData       = new StyRoleRightStorData();
    $styRoleRightStorData->setIdStyRole($roleRight->getIdStyRole());
    $styRoleRightStorData->setIdStyApplication($roleRight->getIdStyApplication());
    $styApplicationStor         = StyApplicationStor::read($roleRight->getIdStyApplication(), $dbConnection);
    $distriXStyApplicationData  = DistriXSvcUtil::setData($styApplicationStor, "DistriXStyApplicationData");
    
    // Modules
    $roleModules                = [];
    list($styRoleRightAppStorData, $styRoleRightAppStorDataInd) = StyRoleRightStor::findByIndRoleAppGroupBy($styRoleRightStorData, $dbConnection);
    foreach ($styRoleRightAppStorData as $roleRightApp) {
      $styModuleStor            = StyModuleStor::read($roleRightApp->getIdStyModule(), $dbConnection);
      $distriXStyModuleData     = DistriXSvcUtil::setData($styModuleStor, "DistriXStyModuleData");
      $distriXStyModuleData->setIdStyApplication($distriXStyApplicationData->getId());
      $distriXStyModuleData->setCodeStyApplication($distriXStyApplicationData->getCode());
      
      // Functionalities
      $roleFunctionalities            = [];
      $styRoleRightStorData->setIdStyModule($roleRightApp->getIdStyModule());
      list($styRoleRightAppModuleStorData, $styRoleRightAppModuleStorDataInd) = StyRoleRightStor::findByIndRoleAppModuleGroupBy($styRoleRightStorData, $dbConnection);
      foreach ($styRoleRightAppModuleStorData as $roleRightAppModule) {
        $styFunctionalityStor         = StyFunctionalityStor::read($roleRightAppModule->getIdStyFunctionality(), $dbConnection);
        $distriXStyFunctionalityData  = DistriXSvcUtil::setData($styFunctionalityStor, "DistriXStyFunctionalityData");
        $distriXStyFunctionalityData->setIdStyModule($styFunctionalityStor->getId());
        $distriXStyFunctionalityData->setCodeStyModule($styFunctionalityStor->getCode());
        
        $roleRights                   = [];
        $styRoleRightStorData->setIdStyFunctionality($roleRightApp->getIdStyFunctionality());
        list($styRoleRightAppModuleFuncStorData, $styRoleRightAppModuleFuncStorDataInd) = StyRoleRightStor::findByIndRoleAppModuleFuncGroupBy($styRoleRightStorData, $dbConnection);
        foreach ($styRoleRightAppModuleFuncStorData as $roleRightAppFunctionality) {
          $styRightStorData           = new StyRightStorData();
          $styRightStorData->setCode($roleRightApp->getSumOfRights());
          
          if ($roleRightApp->getSumOfRights() == DISTRIX_STY_RIGHT_MAX){
            $styRoleRightStorData->setSumOfRights($roleRightApp->getSumOfRights());
            list($styRightStorData, $styRightStorDataInd) = StyRightStor::findByIndCode($styRightStorData, true, $dbConnection);
            $roleRights[]      = DistriXSvcUtil::setData($styRightStorData[$styRightStorDataInd-1], "DistriXStyRightData");
          } else {
            $styRoleRightStorData->setSumOfRights($roleRightApp->getSumOfRights());
            list($styRightStorData, $styRightStorDataInd) = StyRightStor::findAllCodeByIndCode($styRightStorData, true, $dbConnection);
            foreach ($styRightStorData as $right) {
              $roleRights[]    = DistriXSvcUtil::setData($right, "DistriXStyRightData");
            }
          }
          $distriXStyFunctionalityData->setStyRights($roleRights);
        }
        $roleFunctionalities[] = $distriXStyFunctionalityData;
      }
      $distriXStyModuleData->setStyFunctionalities($roleFunctionalities);
      $roleModules[] = $distriXStyModuleData;
    }
    $distriXStyApplicationData->setStyModules($roleModules);
    $roleApplications[] = $distriXStyApplicationData;
  }
  $distriXStyRoleRightData->setStyApplications($roleApplications);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "View", $RightsdataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewRoleRights", $distriXStyRoleRightData);

// Return response
$dataSvc->endOfService();
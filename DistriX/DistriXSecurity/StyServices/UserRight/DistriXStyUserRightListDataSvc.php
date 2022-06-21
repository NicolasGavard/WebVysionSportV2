<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Const/DistriXStyKeys.php");
include(__DIR__ . "/../../Const/DistriXStyRightConst.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyUserRightsData.php");
include(__DIR__ . "/../../Data/DistriXStyUserRightData.php");
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyModuleData.php");
include(__DIR__ . "/../../Data/DistriXStyFunctionalityData.php");
include(__DIR__ . "/../../Data/DistriXStyUserData.php");
include(__DIR__ . "/../../Data/DistriXStyRightData.php");
// Database Data
include(__DIR__ . "/Data/StyApplicationStorData.php");
include(__DIR__ . "/Data/StyFunctionalityStorData.php");
include(__DIR__ . "/Data/StyModuleStorData.php");
include(__DIR__ . "/Data/StyUserRightStorData.php");
include(__DIR__ . "/Data/StyUserStorData.php");
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
include(__DIR__ . "/Storage/StyUserRightStor.php");
include(__DIR__ . "/Storage/StyUserStor.php");
include(__DIR__ . "/Storage/StyRightStor.php");
$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$userRights   = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $distriXStyUserRightData  = new DistriXStyUserRightsData();
  $data                     = $dataSvc->getParameter("data");
  
  $styUserRoleStorData      = new StyUserRoleStorData();
  $styUserRoleStorData->setIdStyUser($data->getIdStyUser());
  $styUserRoleStorData->setIdStyRole($data->getIdStyRole());
  
  if ($data->getIdStyUser() > 0) {
    $function = "findByIndUser";
  }
  if ($data->getIdStyRole() > 0) {
    $function = "findByIndRole";
  }
  
  list($styUserRoleStorData, $styUserRoleStorDataInd) = StyUserRoleStor::$function($styUserRoleStorData, $dbConnection);
  foreach ($styUserRoleStorData as $userRole) {
    $styUserRightsData = DistriXSvcUtil::setData($userRole, "StyUserRightStorData");
    list($styUserRightStorData, $styUserRightStorDataInd) = StyUserRightStor::findByIndUser($styUserRightsData, $dbConnection);
    foreach ($styUserRightStorData as $userRight) {
      $styUserAppStorData     = StyUserStor::read($userRight->getIdStyUser(), $dbConnection);
      $distriXStyUserRightData->setIdStyUser($styUserAppStorData->getId());
      
  
      $distriXStyUserRightData->setCodeRole($styUserAppStorData->getCode());
      $distriXStyUserRightData->setNameRole($styUserAppStorData->getName());
  
      $roleApplications           = [];
      $styUserRightStorData       = new StyUserRightStorData();
      $styUserRightStorData->setIdStyUser($userRight->getIdStyUser());
      $styUserRightStorData->setIdStyApplication($userRight->getIdStyApplication());
      $styApplicationStor         = StyApplicationStor::read($userRight->getIdStyApplication(), $dbConnection);
      $distriXStyApplicationData  = DistriXSvcUtil::setData($styApplicationStor, "DistriXStyApplicationData");
      
      // Modules
      $roleModules                = [];
      list($styUserRightAppStorData, $styUserRightAppStorDataInd) = StyUserRightStor::findByIndUserApp($styUserRightStorData, $dbConnection);
      foreach ($styUserRightAppStorData as $userRightApp) {
        $styModuleStor            = StyModuleStor::read($userRightApp->getIdStyModule(), $dbConnection);
        $distriXStyModuleData     = DistriXSvcUtil::setData($styModuleStor, "DistriXStyModuleData");
        $distriXStyModuleData->setIdStyApplication($distriXStyApplicationData->getId());
        $distriXStyModuleData->setCodeStyApplication($distriXStyApplicationData->getCode());
        
        // Functionalities
        $roleFunctionalities            = [];
        $styUserRightStorData->setIdStyModule($userRightApp->getIdStyModule());
        list($styUserRightAppModuleStorData, $styUserRightAppModuleStorDataInd) = StyUserRightStor::findByIndUserAppModule($styUserRightStorData, $dbConnection);
        foreach ($styUserRightAppModuleStorData as $userRightAppModule) {
          $styFunctionalityStor         = StyFunctionalityStor::read($userRightAppModule->getIdStyFunctionality(), $dbConnection);
          $distriXStyFunctionalityData  = DistriXSvcUtil::setData($styFunctionalityStor, "DistriXStyFunctionalityData");
          $distriXStyFunctionalityData->setIdStyModule($styFunctionalityStor->getId());
          $distriXStyFunctionalityData->setCodeStyModule($styFunctionalityStor->getCode());
          
          $userRights                   = [];
          $styUserRightStorData->setIdStyFunctionality($userRightApp->getIdStyFunctionality());
          list($styUserRightAppModuleFuncStorData, $styUserRightAppModuleFuncStorDataInd) = StyUserRightStor::findByIndUserAppModuleFunc($styUserRightStorData, $dbConnection);
          foreach ($styUserRightAppModuleFuncStorData as $userRightAppFunctionality) {
            $styRightStorData           = new StyRightStorData();
            $styRightStorData->setCode($userRightApp->getSumOfRights());
            
            if ($userRightApp->getSumOfRights() == DISTRIX_STY_RIGHT_MAX){
              $styUserRightStorData->setSumOfRights($userRightApp->getSumOfRights());
              list($styRightStorData, $styRightStorDataInd) = StyRightStor::findByIndCode($styRightStorData, true, $dbConnection);
              $userRights[]      = DistriXSvcUtil::setData($styRightStorData[$styRightStorDataInd-1], "DistriXStyRightData");
            } else {
              $styUserRightStorData->setSumOfRights($userRightApp->getSumOfRights());
              list($styRightStorData, $styRightStorDataInd) = StyRightStor::findAllCodeByIndCode($styRightStorData, true, $dbConnection);
              foreach ($styRightStorData as $right) {
                $userRights[]    = DistriXSvcUtil::setData($right, "DistriXStyRightData");
              }
            }
            $distriXStyFunctionalityData->setStyRights($userRights);
          }
          $roleFunctionalities[] = $distriXStyFunctionalityData;
        }
        $distriXStyModuleData->setStyFunctionalities($roleFunctionalities);
        $roleModules[] = $distriXStyModuleData;
      }
      $distriXStyApplicationData->setStyModules($roleModules);
      $roleApplications[] = $distriXStyApplicationData;
    }
    $distriXStyUserRightData->setStyApplications($roleApplications);
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "View", $RightsdataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewUserRights", $distriXStyUserRightData);

// Return response
$dataSvc->endOfService();
<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyRoleRightData.php");
// Database Data
include(__DIR__ . "/Data/StyApplicationStorData.php");
include(__DIR__ . "/Data/StyFunctionalityStorData.php");
include(__DIR__ . "/Data/StyModuleStorData.php");
include(__DIR__ . "/Data/StyRoleRightStorData.php");
include(__DIR__ . "/Data/StyRoleStorData.php");
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

$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$roleRights   = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data                   = $dataSvc->getParameter("data");
  $styRoleRightsData      = DistriXSvcUtil::setData($data, "StyRoleRightStorData");
  list($styRoleRightsStorData, $styRoleRightsStorDataInd) = StyRoleRightStor::findByIndRole($styRoleRightsData, $dbConnection);
  foreach ($styRoleRightsStorData as $roleRight) {
    $infoRoleRight        = DistriXSvcUtil::setData($roleRight, "DistriXStyRoleRightData");

    $styRoleStor          = StyRoleStor::read($infoRoleRight->getIdStyRole(), $dbConnection);
    $infoRoleRight->setCodeRole($styRoleStor->getCode());
    $infoRoleRight->setNameRole($styRoleStor->getName());

    $styApplicationStor   = StyApplicationStor::read($infoRoleRight->getIdStyApplication(), $dbConnection);
    $infoRoleRight->setCodeApplication($styApplicationStor->getCode());
    $infoRoleRight->setDescriptionApplication($styApplicationStor->getDescription());
    
    $styModuleStor        = StyModuleStor::read($infoRoleRight->getIdStyModule(), $dbConnection);
    $infoRoleRight->setCodeModule($styModuleStor->getCode());
    $infoRoleRight->setDescriptionModule($styModuleStor->getDescription());

    $styFunctionalityStor = StyFunctionalityStor::read($infoRoleRight->getIdStyFunctionality(), $dbConnection);
    $infoRoleRight->setCodeFunctionality($styFunctionalityStor->getCode());
    $infoRoleRight->setDescriptionFunctionality($styFunctionalityStor->getDescription());

    $roleRights[]        = $infoRoleRight;
  }

} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "View", $RightsdataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewRoleRights", $roleRights);

// Return response
$dataSvc->endOfService();
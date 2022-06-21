<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/StyApplicationStorData.php");
include(__DIR__ . "/Data/StyUserRoleStorData.php");
include(__DIR__ . "/Data/StyUserAllRoleStorData.php");
include(__DIR__ . "/Data/StyUserStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserRoleStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

$allRoles     = [];
$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if ($dbConnection != null) {
  list($_data, $jsonError)          = StyApplicationStorData::getJsonData($dataSvc->getParameter("data"));
  list($_infosSession, $jsonError)  = StyUserStorData::getJsonData($dataSvc->getParameter("infoSession"));

  if ($_data != null && $_infosSession != null) {
    $styUserRoleStorData = new StyUserRoleStorData();
    $styUserRoleStorData->setIdStyUser($_infosSession->getId());
    list($allRoles, $allRolesInd) = StyUserRoleStor::findByUser($styUserRoleStorData, $dbConnection);
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse("ApplicationError", $errorData);
}
$dataSvc->addToResponse("StyUserRoles", $allRoles);

// Return response
$dataSvc->endOfService();

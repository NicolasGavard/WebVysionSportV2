<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../../Data/DistriXStyUserRolesData.php");
// Database Data
include(__DIR__ . "/Data/StyUserRoleStorData.php");
include(__DIR__ . "/Data/StyUserAllRoleStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserRoleStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$infoSession  = new DistriXStyInfoSessionData();
$userRoles    = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if ($dbConnection != null) {
  list($_infosSession, $jsonError) = DistriXStyInfoSessionData::getJsonData($dataSvc->getParameter("infoSession"));
  if ($_infosSession != null) {
    $data = new StyUserRoleStorData();
    $data->setIdStyUser($_infosSession->getIdUser());
    list($styUserRoles, $styUserRolesInd) = StyUserRoleStor::findByUser($data, $dbConnection);
    foreach ($styUserRoles as $role) {
      $data = new DistriXStyUserRolesData();
      $data->setIdUser($_infosSession->getIdUser());
      $data->setIdStyRole($role->getIdStyRole());
      $data->setNameStyRole($role->getStyRoleName());
      $userRoles[] = $data;
    }
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addToResponse("ApplicationError", $errorData);
}
$dataSvc->addToResponse("StyUserRoles", $userRoles);

// Return response
$dataSvc->endOfService();

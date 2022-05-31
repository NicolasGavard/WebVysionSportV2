<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../../Data/DistriXStyLoginData.php");
include(__DIR__ . "/../../Data/DistriXStyRoleData.php");
// Database Data
include(__DIR__ . "/Data/StyUserAllRoleStorData.php");
include(__DIR__ . "/Data/StyUserRoleStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserRoleStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";
$dbConnection = null;
$errorData    = null;
$userRoles   = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if ($dbConnection != null) {
  // list($_data, $jsonError) = DistriXStyLoginData::getJsonData($dataSvc->getParameter("data"));
  list($_infosSession, $jsonError) =  DistriXStyInfoSessionData::getJsonData($dataSvc->getParameter("infoSession"));
  if ($_infosSession != null) {
    $styUserRoleStorData = new StyUserRoleStorData();
    $styUserRoleStorData->setIdStyUser($_infosSession->getIdUser());
    list($roles, $rolesInd) = StyUserRoleStor::findByUser($styUserRoleStorData, $dbConnection);
    foreach ($roles as $role) {
      $data = new DistriXStyRoleData();
      $data->setId($role->getIdStyRole());
      $data->setName($role->getStyRoleName());
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

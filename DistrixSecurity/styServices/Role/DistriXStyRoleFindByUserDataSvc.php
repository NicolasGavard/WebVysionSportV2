<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyRoleData.php");
// Database Data
include(__DIR__ . "/Data/StyUserAllRoleStorData.php");
include(__DIR__ . "/Data/StyRoleStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyRoleStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";
$dbConnection = null;
$errorData    = null;
$userRoles   = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if ($dbConnection != null) {
  $_data         = $dataSvc->getParameter("data");
  if ($_data != null && $_infosSession != null) {
    $styUserAllRoleStorData = new StyUserAllRoleStorData();
    $styUserAllRoleStorData->setStyApplicationCode($_data->getApplication());
    $styUserAllRoleStorData->setIdStyUser($_infosSession->getIdUser());
    list($allRoles, $allRolesInd) = StyRoleStor::findAllByUserApp($styUserAllRoleStorData, $dbConnection);
    foreach ($allRoles as $role) {
      $data = new DistriXStyRoleData();
      $data->setApplicationCode($role->getStyApplicationCode());
      $data->setModuleCode($role->getStyModuleCode());
      $data->setFunctionalityCode($role->getStyFunctionalityCode());
      $data->setSumOfRoles($role->getSumOfRoles());
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

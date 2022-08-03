<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyUserRoleData.php");
// Database Data
include(__DIR__ . "/Data/StyRoleStorData.php");
include(__DIR__ . "/Data/StyUserRoleStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyRoleStor.php");
include(__DIR__ . "/Storage/StyUserRoleStor.php");
// Database
$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$usersRole    = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data                 = $dataSvc->getParameter("data");
  $styUserRoleStorData  = DistriXSvcUtil::setData($data, "StyUserRoleStorData");
  $styUserRoleStor      = StyUserRoleStor::getListByRole($styUserRoleStorData, $dbConnection);
  foreach ($styUserRoleStor as $userRole) {
    $infoUserRole       = DistriXSvcUtil::setData($userRole, "DistriXStyUserRoleData");

    $styRoleStor        = StyRoleStor::read($infoUserRole->getIdStyRole(), $dbConnection);
    $infoUserRole->setCodeRole($styRoleStor->getCode());
    $infoUserRole->setNameRole($styRoleStor->getName());
    $usersRole[]        = $infoUserRole;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ViewUser", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListUsersRole", $usersRole);

// Return response
$dataSvc->endOfService();
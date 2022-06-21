<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX STY Init
include(__DIR__.'/../Init/DataSvcInit.php');
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyRoleData.php");
include(__DIR__ . "/../../Data/DistriXStyUserData.php");
// Database Data
include(__DIR__ . "/Data/StyUserStorData.php");
include(__DIR__ . "/Data/StyUserRoleStorData.php");
include(__DIR__ . "/Data/StyRoleStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserStor.php");
include(__DIR__ . "/Storage/StyUserRoleStor.php");
include(__DIR__ . "/Storage/StyRoleStor.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");
// Database
$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $infoUser     = $dataSvc->getParameter("data");
  $userStorData = DistriXSvcUtil::setData($infoUser, "StyUserStorData");
  
  if ($infoUser->getId() > 0) {
    $styUserStor = StyUserStor::read($infoUser->getId(), $dbConnection);
  }
  if ($infoUser->getEmail() != '') {
    $styUserStor = StyUserStor::findByEmail($userStorData, $dbConnection);
  }
  if ($infoUser->getEmailBackup() != '') {
    $styUserStor = StyUserStor::findByEmailBackup($userStorData, $dbConnection);
  }
  
  if($styUserStor->getId() > 0){
    $infoUser    = DistriXSvcUtil::setData($styUserStor, "DistriXStyUserData");
    
    $urlPicture         = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USERS . '/' . $infoUser->getLinkToPicture();
    $pictures_headers = get_headers($urlPicture);
    if (!$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $infoUser->getLinkToPicture() == '') {
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USERS . '/profilDefault.png';
    }
    $infoUser->setLinkToPicture($urlPicture);
    
    $styUserRoleStorData  = new StyUserRoleStorData();
    $styUserRoleStorData->setIdStyUser($styUserStor->getId());
    $styUserRoleStor      = StyUserRoleStor::findByIndUser($styUserRoleStorData, $dbConnection);
    $styRoleStorData      = new StyRoleStorData();
    $styRoleStorData->setId($styUserRoleStor->getIdStyRole());
    $styRoleStor          = StyRoleStor::read($styRoleStorData->getId(), $dbConnection);
    $distriXStyRoleData   = DistriXSvcUtil::setData($styRoleStor, "DistriXStyRoleData");
    
    $infoUser->setRoles($distriXStyRoleData);
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ViewUser", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewUser", $infoUser);

// Return response
$dataSvc->endOfService();
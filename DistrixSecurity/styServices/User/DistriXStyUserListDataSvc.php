<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyUserData.php");
// Database Data
include(__DIR__ . "/Data/StyUserStorData.php");
include(__DIR__ . "/Data/StyEnterpriseStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserStor.php");
include(__DIR__ . "/Storage/StyEnterpriseStor.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnFolderConst.php");
// Database
$databasefile = __DIR__ . "/../Db/Infodb.php";

// ListUsers
if ($dataSvc->getMethodName() == "ListUsers") {
  $dbConnection = null;
  $errorData    = null;
  $users        = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    $data = $dataSvc->getParameter("data");
    
    if ($data->getIdStyEnterprise() == 0) {
      list($styUserstor, $styUserstorInd) = StyUserStor::getList(true, $dbConnection);
    } else if ($data->getIdStyEnterprise() > 0) {
      $styUserstorData = New StyUserStorData();
      $styUserstorData->setIdStyEnterprise($data->getIdStyEnterprise());
      list($styUserstor, $styUserstorInd) = StyUserStor::findByEnterpise($styUserstorData, true, $dbConnection);
    }
    foreach ($styUserstor as $user) {
      $infoUser   = DistriXSvcUtil::setData($user, "DistriXStyUserData");
      
      $styEnterpriseStor = StyEnterpriseStor::read($user->getIdStyEnterprise(), $dbConnection);
      $infoUser->setNameEnterprise($styEnterpriseStor->getName());
      
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USERS . '/' . $user->getLinkToPicture();
      $pictures_headers = get_headers($urlPicture);
      if ($user->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $user->getLinkToPicture() == '') {
        $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USERS . '/profilDefault.png';
      }
      $infoUser->setLinkToPicture($urlPicture);
      $users[] = $infoUser;
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListUsers", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ListUsers", $users);
}

// Return response
$dataSvc->endOfService();

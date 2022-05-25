<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyLoginData.php");
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyUserData.php");
// Database Data
include(__DIR__ . "/Data/StyUserStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserStor.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// Login
if ($dataSvc->getMethodName() == "Login") {
  $dbConnection = null;
  $errorData    = null;
  $infoUser     = new DistriXStyUserData();
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    $data       = $dataSvc->getParameter("data");
    $storData   = new StyUserStorData();
    $storData->setLogin($data->getLogin());
    $storData   = StyUserStor::findByLogin($storData, $dbConnection);
    if ($storData->getPass() == $data->getPassword()) {
      $infoUser = DistriXSvcUtil::setData($storData, "DistriXStyUserData");

      $urlPicture       = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USERS . '/' . $storData->getLinkToPicture();
      $pictures_headers = get_headers($urlPicture);
      if (!$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found') {
        $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USERS . '/profilDefault.png';
      }
      $infoUser->setLinkToPicture($urlPicture);

      $infoUser->setId($storData->getId());
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("StyInfoUser", $infoUser);
}

// Return response
$dataSvc->endOfService();

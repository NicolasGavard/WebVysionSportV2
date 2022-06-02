<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
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
  $styUserStor  = new StyUserStorData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if ($dbConnection != null) {
    list($data, $jsonError) = StyUserStorData::getJsonData($dataSvc->getParameter("dataUser"));
    $styUserStor  = StyUserStor::findByLogin($data, $dbConnection);
    if ($styUserStor->getId() > 0){
      if ($styUserStor->getPass() == $data->getPass()) {
        $urlPicture       = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USERS . '/' . $styUserStor->getLinkToPicture();
        $pictures_headers = @get_headers($urlPicture);
        if (!$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found') {
          $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USERS . '/profilDefault.png';
        }
        $styUserStor->setLinkToPicture($urlPicture);
      } else {
        $styUserStor          = new StyUserStorData();
        $distriXSvcErrorData  = new DistriXSvcErrorData();
        $distriXSvcErrorData->setCode("400");
        $distriXSvcErrorData->setDefaultText("The password does not match");
        $distriXSvcErrorData->setText("ERROR_PASSWORD");
        $errorData = $distriXSvcErrorData;
      }
    } else {
      $styUserStor          = new StyUserStorData();
      $distriXSvcErrorData  = new DistriXSvcErrorData();
      $distriXSvcErrorData->setCode("400");
      $distriXSvcErrorData->setDefaultText("The login does not exist");
      $distriXSvcErrorData->setText("ERROR_LOGIN");
      $errorData = $distriXSvcErrorData;
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse("ApplicationError", $errorData);
  }
  $dataSvc->addToResponse("StyInfoSession", $styUserStor);
}

// Return response
$dataSvc->endOfService();


<?php // Needed to encode in UTF8 ààéàé //
// STY Init
include(__DIR__.'/../Init/DataSvcInit.php');

if (isset($dataSvc) && !is_null($dataSvc) && $dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/StyUserStorData.php");
  include(__DIR__ . "/Data/StyEnterpriseStorData.php");
  // Storage
  include(__DIR__ . "/Storage/StyUserStor.php");
  include(__DIR__ . "/Storage/StyEnterpriseStor.php");
  // Cdn Location
  include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnLocationConst.php");
  include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

  $styUserstor = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($data, $jsonError) = StyUserStorData::getJsonData($dataSvc->getParameter("data"));
    
    if ($data->getIdStyEnterprise() == 0) {
      list($styUserstor, $styUserstorInd) = StyUserStor::getList(true, $dbConnection);
    } else if ($data->getIdStyEnterprise() > 0) {
      $styUserstorData = New StyUserStorData();
      $styUserstorData->setIdStyEnterprise($data->getIdStyEnterprise());
      list($styUserstor, $styUserstorInd) = StyUserStor::findByEnterpise($styUserstorData, true, $dbConnection);
    }
    foreach ($styUserstor as $user) {
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USERS . '/' . $user->getLinkToPicture();
      $pictures_headers = get_headers($urlPicture);
      if ($user->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $user->getLinkToPicture() == '') {
        $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USERS . '/profilDefault.png';
      }
      $user->setLinkToPicture($urlPicture);
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListUsers", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ListUsers", $styUserstor);

  // Return response
  $dataSvc->endOfService();
}

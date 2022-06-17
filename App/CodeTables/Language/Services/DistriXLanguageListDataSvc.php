<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/LanguageStorData.php");
  // Storage
  include(__DIR__ . "/Storage/LanguageStor.php");
  // Cdn Location
  include(__DIR__ . "/".SERVICES_DISTRIX_PATH."DistriXCdn/Const/DistriXCdnLocationConst.php");
  include(__DIR__ . "/".SERVICES_DISTRIX_PATH."DistriXCdn/Const/DistriXCdnFolderConst.php");

  $languageStor = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($languageStor, $languageStorInd) = LanguageStor::getList(true, $dbConnection);
    foreach ($languageStor as $language) {
      
      if( ini_get('allow_url_fopen') ) {
        $urlPicture   = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/' . $language->getLinkToPicture();
        $pictures_headers = get_headers($urlPicture);
        if ($language->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $language->getLinkToPicture() == '') {
          $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/default.png';
        }
      }else {
        if (strlen($language->getLinkToPicture() == 0)){
          $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/default.png';
        }
      }
      $language->setLinkToPicture($urlPicture);
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListLanguages", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ListLanguages", $languageStor);

  // Return response
  $dataSvc->endOfService();
}

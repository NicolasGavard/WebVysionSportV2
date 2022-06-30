<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/LanguageStor.php");
// Database Data
include(__DIR__ . "/Data/LanguageStorData.php");
  // Cdn Location
  include(__DIR__ . "/".SERVICES_DISTRIX_PATH."DistriXCdn/Const/DistriXCdnLocationConst.php");
  include(__DIR__ . "/".SERVICES_DISTRIX_PATH."DistriXCdn/Const/DistriXCdnFolderConst.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($data, $jsonError) = LanguageStorData::getJsonData($dataSvc->getParameter("data"));
  $languageStorData       = LanguageStor::read($data->getId(), $dbConnection);
  $urlPicture             = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/' . $languageStorData->getLinkToPicture();
  $pictures_headers       = get_headers($urlPicture);
  if ($languageStorData->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $languageStorData->getLinkToPicture() == '') {
    $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/default.png';
  }
  $languageStorData->setLinkToPicture($urlPicture);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewLanguage", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewLanguage", $languageStorData);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/StyLanguageStorData.php");
// Storage
include(__DIR__ . "/Storage/StyLanguageStor.php");
// Cdn Location
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$Languages    = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data = $dataSvc->getParameter("data");
  list($styLanguagestor, $styLanguagestorInd) = StyLanguageStor::findByIndCode($data, true, $dbConnection);
  foreach ($styLanguagestor as $Language) {
    $infoLanguage = DistriXSvcUtil::setData($Language, "DistriXStyLanguageData");
    $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_LANGUAGES . '/' . $infoLanguage->getLinkToPicture();
    $pictures_headers = get_headers($urlPicture);
    if ($infoLanguage->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $infoLanguage->getLinkToPicture() == '') {
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_LANGUAGES . '/languageDefault.png';
    }
    $infoLanguage->setLinkToPicture($urlPicture);
    $Languages[]  = $infoLanguage;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "FindEcoScore", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListLanguages", $Languages);

// Return response
$dataSvc->endOfService();

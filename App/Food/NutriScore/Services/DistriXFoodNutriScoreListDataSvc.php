<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/ScoreNutriStorData.php");
// Storage
include(__DIR__ . "/Storage/ScoreNutriStor.php");
// Cdn Location
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnFolderConst.php");

$scoreNutriStor = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($scoreNutriStor, $scoreNutriStorInd) = ScoreNutriStor::getList(true, $dbConnection);
  foreach ($scoreNutriStor as $scoreNutri) {
    $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/' . $scoreNutri->getLinkToPicture();
    $pictures_headers = get_headers($urlPicture);
    if ($scoreNutri->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $scoreNutri->getLinkToPicture() == '') {
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/default.png';
    }
    $scoreNutri->setLinkToPicture($urlPicture);
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListNutriScores", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListNutriScores", $scoreNutriStor);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/ScoreEcoStorData.php");
// Storage
include(__DIR__ . "/Storage/ScoreEcoStor.php");
// Cdn Location
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnFolderConst.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($data, $jsonError) = ScoreEcoStorData::getJsonData($dataSvc->getParameter("data"));
  $scoreEcoStor     = ScoreEcoStor::read($data->getId(), $dbConnection);
  $urlPicture       = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/' . $scoreEcoStor->getLinkToPicture();
  $pictures_headers = get_headers($urlPicture);
  if ($scoreEcoStor->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $scoreEcoStor->getLinkToPicture() == '') {
    $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/default.png';
  }
  $scoreEcoStor->setLinkToPicture($urlPicture);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewEcoScore", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewEcoScore", $scoreEcoStor);

// Return response
$dataSvc->endOfService();

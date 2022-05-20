<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/Data/DistriXFoodScoreEcoData.php");
// Database Data
include(__DIR__ . "/Data/ScoreEcoStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/ScoreEcoStor.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data = $dataSvc->getParameter("data");
  $scoreEcoStor = ScoreEcoStor::read($data->getId(), $dbConnection);
  $infoScoreEco = DistriXSvcUtil::setData($scoreEcoStor, "DistriXFoodScoreEcoData");
  $urlPicture   = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/' . $infoScoreEco->getLinkToPicture();
  $pictures_headers = get_headers($urlPicture);
  if ($infoScoreEco->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $infoScoreEco->getLinkToPicture() == '') {
    $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/default.png';
  }
  $infoScoreEco->setLinkToPicture($urlPicture);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListScoreEcos", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewScoreEco", $infoScoreEco);

// Return response
$dataSvc->endOfService();

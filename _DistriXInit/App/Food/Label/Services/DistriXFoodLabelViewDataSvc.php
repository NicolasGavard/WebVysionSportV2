<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/LabelStor.php");
// Database Data
include(__DIR__ . "/Data/LabelStorData.php");
// Cdn Location
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnFolderConst.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($data, $jsonError) = LabelStorData::getJsonData($dataSvc->getParameter("data"));
  $labelStorData    = LabelStor::read($data->getId(), $dbConnection);
  $urlPicture       = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/' . $labelStorData->getLinkToPicture();
  $pictures_headers = get_headers($urlPicture);
  if ($labelStorData->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $labelStorData->getLinkToPicture() == '') {
    $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/default.png';
  }
  $labelStorData->setLinkToPicture($urlPicture);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewLabel", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewLabel", $labelStorData);

// Return response
$dataSvc->endOfService();

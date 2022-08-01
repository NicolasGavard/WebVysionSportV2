<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Storage
  include(__DIR__ . "/Storage/BrandStor.php");
  // Database Data
  include(__DIR__ . "/Data/BrandStorData.php");
  // Cdn Location
  include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnLocationConst.php");
  include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($data, $jsonError) = BrandStorData::getJsonData($dataSvc->getParameter("data"));
    $brandStorData    = BrandStor::read($data->getId(), $dbConnection);
    $urlPicture       = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/' . $brandStorData->getLinkToPicture();
    $pictures_headers = get_headers($urlPicture);
    if ($brandStorData->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $brandStorData->getLinkToPicture() == '') {
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/default.png';
    }
    $brandStorData->setLinkToPicture($urlPicture);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ViewBrand", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ViewBrand", $brandStorData);
}
// Return response
$dataSvc->endOfService();

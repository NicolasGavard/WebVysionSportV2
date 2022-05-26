<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/BrandStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/BrandStor.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;
$brandStor    = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($brandStor, $brandStorInd) = BrandStor::getList(true, $dbConnection);
  foreach ($brandStor as $brand) {
    $urlPicture   = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/' . $brand->getLinkToPicture();
    $pictures_headers = get_headers($urlPicture);
    if ($brand->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $brand->getLinkToPicture() == '') {
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/default.png';
    }
    $brand->setLinkToPicture($urlPicture);
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListBrands", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ListBrands", $brandStor);

// Return response
$dataSvc->endOfService();

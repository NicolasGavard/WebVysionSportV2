<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/LabelStor.php");
// Database Data
include(__DIR__ . "/Data/LabelStorData.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;
$labelStor    = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($labelStor, $labelStorInd) = LabelStor::getList(true, $dbConnection);
  foreach ($labelStor as $label) {
    $urlPicture   = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/' . $label->getLinkToPicture();
    $pictures_headers = get_headers($urlPicture);
    if ($label->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $label->getLinkToPicture() == '') {
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/default.png';
    }
    $label->setLinkToPicture($urlPicture);
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListLabels", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ListLabels", $labelStor);

// Return response
$dataSvc->endOfService();

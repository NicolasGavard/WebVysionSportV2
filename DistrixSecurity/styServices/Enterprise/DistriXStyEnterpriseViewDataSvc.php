<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyEnterpriseData.php");
// Database Data
include(__DIR__ . "/Data/StyEnterpriseStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyEnterpriseStor.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data = $dataSvc->getParameter("data");
  $styEnterpriseStor = StyEnterpriseStor::read($data->getId(), $dbConnection);
  $infoEnterprise    = DistriXSvcUtil::setData($styEnterpriseStor, "DistriXStyEnterpriseData");

  $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_ENTERPRISE . '/' . trim($infoEnterprise->getLogoImageHtmlName());
  $pictures_headers = @get_headers($urlPicture);
  if (trim($infoEnterprise->getLogoImageHtmlName()) == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found') {
    $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_ENTERPRISE . '/enterpriseDefault.png';
  }
  $infoEnterprise->setLogoImageHtmlName($urlPicture);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListEnterprises", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewEnterprise", $infoEnterprise);

// Return response
$dataSvc->endOfService();

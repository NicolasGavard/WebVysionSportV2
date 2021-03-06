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
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile    = __DIR__ . "/../Db/Infodb.php";

// ListEnterprises
if ($dataSvc->getMethodName() == "ListEnterprises") {
  $dbConnection    = null;
  $errorData       = null;
  $enterprisesList = [];
  
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($enterprisesStorData, $enterprisesStorDataInd) = StyEnterpriseStor::getList(true, $dbConnection);
    foreach ($enterprisesStorData as $enterprise) {
      $data = DistriXSvcUtil::setData($enterprise, "DistriXStyEnterpriseData");
      
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_ENTERPRISE . '/' . trim($data->getLogoImageHtmlName());
      $pictures_headers = get_headers($urlPicture);
      if (trim($data->getLogoImageHtmlName()) == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found') {
        $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_ENTERPRISE . '/enterpriseDefault.png';
      }
      $data->setLogoImageHtmlName($urlPicture);

      $enterprisesList[] = $data;
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }


  $dataSvc->addToResponse("ListEnterprises", $enterprisesList);
}

// Return response
$dataSvc->endOfService();

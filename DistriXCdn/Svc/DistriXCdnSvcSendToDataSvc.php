<?php
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// Const
include("../DistriXCdn/Const/DistriXCdnErrorConst.php");
include("../DistriXCdn/Const/DistriXCdnFolderConst.php");
include("../DistriXCdn/Const/DistriXCdnLocationConst.php");
// Error
include("Data/DistriXSvcErrorData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXCdnSvcCaller.php");
// Data
include(__DIR__ . "/../Data/DistriXCdnData.php");

$image      = null;
$cdnSvcCall = new DistriXCdnSvcCaller();
$errors     = [];

$parameters = $dataSvc->getRawParameters(); // As we do not know the parameter name which is the image name. Yvan 08-Mar-22
if (is_array($parameters) && !empty($parameters)) {
  list($image, $jsonError) = DistriXCdnData::getJsonData($parameters[array_key_first($parameters)]); // Works from PHP 7.3.0
}
if ($image != null) {
  if (strlen($image->getImageGroup()) > 0 && strlen($image->getImageFamily()) > 0) {
    $groupLocation = DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES;
    if ($image->getImageGroup() == DISTRIX_CDN_GROUP_MOVIES) {
      $groupLocation = DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES;
    }
    $filename  = __DIR__ . "/" . $groupLocation . $image->getImageFamily() . '/' . $image->getImageName();
    if (file_put_contents($filename, base64_decode($image->getImage())) === FALSE) {
      $errorData = new DistriXSvcErrorData();
      $errorData->setCode(DISTRIX_CDN_BAD_FILENAME_CODE);
      $errorData->setTextToAllText(DISTRIX_CDN_BAD_FILENAME_TEXT . " " . $filename);
      $errorData->setApplicationModuleFunctionalityCodeAndFilename(DISTRIX_CDN_SERVICES, DISTRIX_CDN_FOLDER_SEND_TO, "", basename(__FILE__));
      $errors[] = $errorData;
    }
  } else {
    if (strlen($image->getImageGroup()) > 0) {
      $errorData = new DistriXSvcErrorData();
      $errorData->setCode(DISTRIX_CDN_GROUP_NOT_FOUND_CODE);
      $errorData->setTextToAllText(DISTRIX_CDN_GROUP_NOT_FOUND_TXT);
      $errorData->setApplicationModuleFunctionalityCodeAndFilename(DISTRIX_CDN_SERVICES, DISTRIX_CDN_FOLDER_SEND_TO, "", basename(__FILE__));
      $errors[] = $errorData;
    }
    if (strlen($image->getImageFamily()) > 0) {
      $errorData = new DistriXSvcErrorData();
      $errorData->setCode(DISTRIX_CDN_FAMILY_NOT_FOUND_CODE);
      $errorData->setTextToAllText(DISTRIX_CDN_FAMILY_NOT_FOUND_TXT);
      $errorData->setApplicationModuleFunctionalityCodeAndFilename(DISTRIX_CDN_SERVICES, DISTRIX_CDN_FOLDER_SEND_TO, "", basename(__FILE__));
      $errors[] = $errorData;
    }
  }
} else {
  $errorData = new DistriXSvcErrorData();
  $errorData->setCode(DISTRIX_CDN_FILE_NOT_FOUND_CODE);
  $errorData->setTextToAllText(DISTRIX_CDN_FILE_NOT_FOUND_TXT);
  $errorData->setApplicationModuleFunctionalityCodeAndFilename(DISTRIX_CDN_SERVICES, DISTRIX_CDN_FOLDER_SEND_TO, "", basename(__FILE__));
  $errors[] = $errorData;
}
if (!empty($errors)) {
  $dataSvc->addErrorToResponse($errors);
}
// Return response
$dataSvc->endOfService();

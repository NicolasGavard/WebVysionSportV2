<?php
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// Error
include("Data/DistriXSvcErrorData.php");
// Const
include("../DistriXDeployer/Const/DistriXDeployerErrorConst.php");
// Data
include(__DIR__ . "/../Data/DistriXDeployerSentData.php");

$errors           = [];
$listFiles        = $dataSvc->getParameter("data");

if (!empty($listFiles)) {
  for ($indFiles = 0; $indFiles < count($listFiles); $indFiles++) {
    $fullPath = '../'.$listFiles[$indFiles]->getPath().$listFiles[$indFiles]->getFile();
    if (file_exists($fullPath)) {
      if (file_get_contents($fullPath, false) === FALSE) {
        $errorData = new DistriXSvcErrorData();
        $errorData->setCode(DISTRIX_DEPLOYER_BAD_FILENAME_CODE);
        $errorData->setTextToAllText(DISTRIX_DEPLOYER_BAD_FILENAME_TEXT . " " . $fullPath);
        $errorData->setApplicationModuleFunctionalityCodeAndFilename(DISTRIX_DEPLOYER_SERVICES, DISTRIX_DEPLOYER_SEND_TO, "", basename(__FILE__));
        $errors[] = $errorData;
      } else {
        $listFiles[$indFiles]->setContent(file_get_contents($fullPath, false));
      }
    } else {
      $errorData = new DistriXSvcErrorData();
      $errorData->setCode(DISTRIX_DEPLOYER_FILE_NOT_FOUND_CODE);
      $errorData->setTextToAllText(DISTRIX_DEPLOYER_FILE_NOT_FOUND_TXT);
      $errorData->setApplicationModuleFunctionalityCodeAndFilename(DISTRIX_DEPLOYER_SERVICES, DISTRIX_DEPLOYER_SEND_TO, "", basename(__FILE__));
      $errors[] = $errorData;
    }
  }
} else {
  $errorData = new DistriXSvcErrorData();
  $errorData->setCode(DISTRIX_DEPLOYER_FILE_LIST_EMPTY_CODE);
  $errorData->setTextToAllText(DISTRIX_DEPLOYER_FILE_LIST_EMPTY_TXT);
  $errorData->setApplicationModuleFunctionalityCodeAndFilename(DISTRIX_DEPLOYER_SERVICES, DISTRIX_DEPLOYER_SEND_TO, "", basename(__FILE__));
  $errors[] = $errorData;
}
if (!empty($errors)) {
  $dataSvc->addErrorToResponse($errors);
}
$dataSvc->addToResponse('ListDownloadedFiles', $listFiles);
// Return response
$dataSvc->endOfService();

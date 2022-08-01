<?php
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// Error
include("Data/DistriXSvcErrorData.php");
// Const
include("../DistriXDeployer/Const/DistriXDeployerErrorConst.php");
// Data
include(__DIR__ . "/../Data/DistriXDeployerSentData.php");

$errors                   = [];
$listFiles                = $dataSvc->getParameter("data");
$confirmedFilesTransfert  = false;

if (!empty($listFiles)) {
  for ($indFiles = 0; $indFiles < count($listFiles); $indFiles++) {
    // Si le fichier exist le renommer avec la date du jour puis copier
    $fullPath = __DIR__.'/../../'.$listFiles[$indFiles]->getPath().$listFiles[$indFiles]->getFile();
    
    // Check if folder exist
    if (!file_exists($fullPath)) {
      mkdir($fullPath);
    }
    
    if (file_exists($fullPath)) {
      $filePath                 = $fullPath;
      $extension                = pathinfo($filePath, PATHINFO_EXTENSION);
      $filePathWithoutExtention = pathinfo($fullPath, PATHINFO_FILENAME);
      $newfilePath              = __DIR__.'/../../'.$listFiles[$indFiles]->getPath().$filePathWithoutExtention.'-'.date('Ymd-Hi').'.'.$extension;   
      
      // Copy of file for backup
      if (copy($filePath, $newfilePath)) {
        // Copy new file
        if (file_put_contents($fullPath, $listFiles[$indFiles]->getContent()) === FALSE) {
          $errorData = new DistriXSvcErrorData();
          $errorData->setCode(DISTRIX_DEPLOYER_BAD_FILENAME_CODE);
          $errorData->setTextToAllText(DISTRIX_DEPLOYER_BAD_FILENAME_TEXT . " " . $fullPath);
          $errorData->setApplicationModuleFunctionalityCodeAndFilename(DISTRIX_DEPLOYER_SERVICES, DISTRIX_DEPLOYER_SEND_TO, "", basename(__FILE__));
          $errors[] = $errorData;
        } else {
          $confirmedFilesTransfert = true;
        }
      } else {
        $confirmedFilesTransfert = false;
        $errorData = new DistriXSvcErrorData();
        $errorData->setCode(DISTRIX_DEPLOYER_BAD_COPY_FILENAME_CODE);
        $errorData->setTextToAllText(DISTRIX_DEPLOYER_BAD_COPY_FILENAME_TEXT . " " . $fullPath);
        $errorData->setApplicationModuleFunctionalityCodeAndFilename(DISTRIX_DEPLOYER_SERVICES, DISTRIX_DEPLOYER_SEND_TO, "", basename(__FILE__));
        $errors[] = $errorData;
      }
    }
  }
} else {
  $confirmedFilesTransfert = false;
  $errorData = new DistriXSvcErrorData();
  $errorData->setCode(DISTRIX_DEPLOYER_FILE_NOT_FOUND_CODE);
  $errorData->setTextToAllText(DISTRIX_DEPLOYER_FILE_NOT_FOUND_TXT);
  $errorData->setApplicationModuleFunctionalityCodeAndFilename(DISTRIX_DEPLOYER_SERVICES, DISTRIX_DEPLOYER_SEND_TO, "", basename(__FILE__));
  $errors[] = $errorData;
}
if (!empty($errors)) {
  $dataSvc->addErrorToResponse($errors);
}
$dataSvc->addToResponse('ConfirmedFilesTransfert', $confirmedFilesTransfert);
// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX STY Init
include(__DIR__.'/../Init/DataSvcInit.php');
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyUserData.php");
// Database Data
include(__DIR__ . "/Data/StyUserStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserStor.php");
// Distrix CDN
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");
$databasefile = __DIR__ . "/../Db/Infodb.php";

// DelUser
if ($dataSvc->getMethodName() == "DelUser") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoUser     = new DistriXStyUserData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoUser     = $dataSvc->getParameter("data");
      $styUserstor  = StyUserStor::read($infoUser->getId(), $dbConnection);
      $insere       = StyUserStor::remove($styUserstor, $dbConnection);
      
      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($infoUser->getId() > 0) {
          $errorData = ApplicationErrorData::warningUpdateData(1, 1);
        } else {
          $errorData = ApplicationErrorData::warningInsertData(1, 1);
        }
      }
    } else {
      $errorData = ApplicationErrorData::noBeginTransaction(1, 1);
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }

  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "DelUser", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSaveUser", $insere);
}

// Return response
$dataSvc->endOfService();

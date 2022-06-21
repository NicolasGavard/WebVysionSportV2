<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX STY Init
include(__DIR__.'/../Init/DataSvcInit.php');
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
// Database Data
include(__DIR__ . "/Data/StyApplicationStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyApplicationStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// SaveApplication
if ($dataSvc->getMethodName() == "SaveApplication") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoApplication     = new DistriXStyApplicationData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoApplication     = $dataSvc->getParameter("data");
      $applicationStorData = DistriXSvcUtil::setData($infoApplication, "StyApplicationStorData");
      $canSaveApplication  = true;
      if ($infoApplication->getId() == 0) {
        // Verify Code Exist
        list($styApplicationStor, $styApplicationStorInd) = StyApplicationStor::findByIndCode($applicationStorData, true, $dbConnection);
        if ($styApplicationStorInd > 0) {
          $canSaveApplication          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoApplication->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveApplication) {
        $applicationStorData = new StyApplicationStorData();
        $applicationStorData->setId($infoApplication->getId());
        $applicationStorData->setCode($infoApplication->getCode());
        $applicationStorData->setDescription($infoApplication->getDescription());
        $applicationStorData->setStatus($infoApplication->getStatus());
        $applicationStorData->setTimestamp($infoApplication->getTimestamp());
        list($insere, $idStyApplication) = StyApplicationStor::save($applicationStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoApplication->getId() > 0) {
            $errorData = ApplicationErrorData::warningUpdateData(1, 1);
          } else {
            $errorData = ApplicationErrorData::warningInsertData(1, 1);
          }
        }
      }
    } else {
      $errorData = ApplicationErrorData::noBeginTransaction(1, 1);
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }

  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSaveApplication", $insere);
}

// Return response
$dataSvc->endOfService();

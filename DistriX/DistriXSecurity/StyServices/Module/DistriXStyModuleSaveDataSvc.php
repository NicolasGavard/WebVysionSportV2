<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyModuleData.php");
// Database Data
include(__DIR__ . "/Data/StyModuleStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyModuleStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// SaveModule
if ($dataSvc->getMethodName() == "SaveModule") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoModule     = new DistriXStyModuleData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoModule     = $dataSvc->getParameter("data");
      $applicationStorData = DistriXSvcUtil::setData($infoModule, "StyModuleStorData");
      $canSaveModule  = true;
      if ($infoModule->getId() == 0) {
        // Verify Code Exist
        list($styModuleStor, $styModuleStorInd) = StyModuleStor::findByIndCode($applicationStorData, true, $dbConnection);
        if ($styModuleStorInd > 0) {
          $canSaveModule          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoModule->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveModule) {
        $applicationStorData = new StyModuleStorData();
        $applicationStorData->setId($infoModule->getId());
        $applicationStorData->setIdStyApplication($infoModule->getIdStyApplication());
        $applicationStorData->setCode($infoModule->getCode());
        $applicationStorData->setDescription($infoModule->getDescription());
        $applicationStorData->setStatus($infoModule->getStatus());
        $applicationStorData->setTimestamp($infoModule->getTimestamp());
        list($insere, $idStyModule) = StyModuleStor::save($applicationStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoModule->getId() > 0) {
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

  $dataSvc->addToResponse("ConfirmSaveModule", $insere);
}

// Return response
$dataSvc->endOfService();

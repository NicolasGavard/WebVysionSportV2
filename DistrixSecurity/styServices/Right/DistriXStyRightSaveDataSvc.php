<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyRightData.php");
// Database Data
include(__DIR__ . "/Data/StyRightStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyRightStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// SaveRight
if ($dataSvc->getMethodName() == "SaveRight") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoRight     = new DistriXStyRightData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoRight     = $dataSvc->getParameter("data");
      $rightStorData = DistriXSvcUtil::setData($infoRight, "StyRightStorData");
      $canSaveRight  = true;
      if ($infoRight->getId() == 0) {
        // Verify Code Exist
        list($styRightStor, $styRightStorInd) = StyRightStor::findByIndCode($rightStorData, true, $dbConnection);
        if ($styRightStorInd > 0) {
          $canSaveRight          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoRight->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveRight) {
        $rightStorData = new StyRightStorData();
        $rightStorData->setId($infoRight->getId());
        $rightStorData->setCode($infoRight->getCode());
        $rightStorData->setName($infoRight->getName());
        $rightStorData->setDescription($infoRight->getDescription());
        $rightStorData->setStatus($infoRight->getStatus());
        $rightStorData->setTimestamp($infoRight->getTimestamp());
        list($insere, $idStyRight) = StyRightStor::save($rightStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoRight->getId() > 0) {
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

  $dataSvc->addToResponse("ConfirmSaveRight", $insere);
}

// Return response
$dataSvc->endOfService();

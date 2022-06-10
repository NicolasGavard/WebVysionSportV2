<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyUserRightData.php");
// Database Data
include(__DIR__ . "/Data/StyUserRightStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserRightStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// SaveUserRight
if ($dataSvc->getMethodName() == "SaveUserRight") {
  $dbConnection   = null;
  $errorData      = null;
  $insere         = false;
  $infoUserRight  = new DistriXStyUserRightData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoUserRight = $dataSvc->getParameter("data");
      $rightStorData = DistriXSvcUtil::setData($infoUserRight, "StyUserRightStorData");
      $canSaveUserRight  = true;
      if ($infoUserRight->getId() == 0) {
        // Verify Code Exist
        list($styUserRightStor, $styUserRightStorInd) = StyUserRightStor::findByIndUserAppModuleFunc($rightStorData, $dbConnection);
        if ($styUserRightStorInd > 0) {
          $canSaveUserRight          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The recording " . $infoUserRight->getSumOfRights() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveUserRight) {
        $rightStorData = new StyUserRightStorData();
        $rightStorData->setId($infoUserRight->getId());
        $rightStorData->setIdStyUser($infoUserRight->getIdStyUser());
        $rightStorData->setIdStyApplication($infoUserRight->getIdStyApplication());
        $rightStorData->setIdStyModule($infoUserRight->getIdStyModule());
        $rightStorData->setIdStyFunctionality($infoUserRight->getIdStyFunctionality());
        $rightStorData->setSumOfRights($infoUserRight->getSumOfRights());
        list($insere, $idStyUserRight) = StyUserRightStor::save($rightStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoUserRight->getId() > 0) {
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

  $dataSvc->addToResponse("ConfirmSaveUserRight", $insere);
}

// Return response
$dataSvc->endOfService();

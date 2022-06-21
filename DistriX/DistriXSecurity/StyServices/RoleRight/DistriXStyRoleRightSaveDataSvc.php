<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyRoleRightData.php");
// Database Data
include(__DIR__ . "/Data/StyRoleRightStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyRoleRightStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// SaveRoleRight
if ($dataSvc->getMethodName() == "SaveRoleRight") {
  $dbConnection   = null;
  $errorData      = null;
  $insere         = false;
  $infoRoleRight  = new DistriXStyRoleRightData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoRoleRight = $dataSvc->getParameter("data");
      $rightStorData = DistriXSvcUtil::setData($infoRoleRight, "StyRoleRightStorData");
      $canSaveRoleRight  = true;
      if ($infoRoleRight->getId() == 0) {
        // Verify Code Exist
        list($styRoleRightStor, $styRoleRightStorInd) = StyRoleRightStor::findByIndRoleAppModuleFunc($rightStorData, $dbConnection);
        if ($styRoleRightStorInd > 0) {
          $canSaveRoleRight          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The recording " . $infoRoleRight->getSumOfRights() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveRoleRight) {
        $rightStorData = new StyRoleRightStorData();
        $rightStorData->setId($infoRoleRight->getId());
        $rightStorData->setIdStyRole($infoRoleRight->getIdStyRole());
        $rightStorData->setIdStyApplication($infoRoleRight->getIdStyApplication());
        $rightStorData->setIdStyModule($infoRoleRight->getIdStyModule());
        $rightStorData->setIdStyFunctionality($infoRoleRight->getIdStyFunctionality());
        $rightStorData->setSumOfRights($infoRoleRight->getSumOfRights());
        list($insere, $idStyRoleRight) = StyRoleRightStor::save($rightStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoRoleRight->getId() > 0) {
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

  $dataSvc->addToResponse("ConfirmSaveRoleRight", $insere);
}

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyRoleData.php");
// Database Data
include(__DIR__ . "/Data/StyRoleStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyRoleStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// SaveRole
if ($dataSvc->getMethodName() == "SaveRole") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoRole     = new DistriXStyRoleData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoRole     = $dataSvc->getParameter("data");
      $roleStorData = DistriXSvcUtil::setData($infoRole, "StyRoleStorData");
      $canSaveRole  = true;
      if ($infoRole->getId() == 0) {
        // Verify Code Exist
        list($styRoleStor, $styRoleStorInd) = StyRoleStor::findByIndCode($roleStorData, true, $dbConnection);
        if ($styRoleStorInd > 0) {
          $canSaveRole          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoRole->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveRole) {
        $roleStorData = new StyRoleStorData();
        $roleStorData->setId($infoRole->getId());
        $roleStorData->setCode($infoRole->getCode());
        $roleStorData->setName($infoRole->getName());
        $roleStorData->setDescription($infoRole->getDescription());
        $roleStorData->setStatus($infoRole->getStatus());
        $roleStorData->setTimestamp($infoRole->getTimestamp());
        list($insere, $idStyRole) = StyRoleStor::save($roleStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoRole->getId() > 0) {
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

  $dataSvc->addToResponse("ConfirmSaveRole", $insere);
}

// Return response
$dataSvc->endOfService();

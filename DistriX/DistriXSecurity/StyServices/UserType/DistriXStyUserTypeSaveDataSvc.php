<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyUserTypeData.php");
// Database Data
include(__DIR__ . "/Data/StyUserTypeStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserTypeStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// SaveUserType
if ($dataSvc->getMethodName() == "SaveUserType") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoUserType = new DistriXStyUserTypeData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoUserType     = $dataSvc->getParameter("data");
      $userTypeStorData = DistriXSvcUtil::setData($infoUserType, "StyUserTypeStorData");
      $canSaveUserType  = true;
      if ($infoUserType->getId() == 0) {
        // Verify Code Exist
        $styUserTypeStor = StyUserTypeStor::findByIndCode($userTypeStorData, $dbConnection);
        if ($styUserTypeStor->getId() > 0) {
          $canSaveUserType          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoUserType->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveUserType) {
        $userTypeStorData = new StyUserTypeStorData();
        $userTypeStorData->setId($infoUserType->getId());
        $userTypeStorData->setCode($infoUserType->getCode());
        $userTypeStorData->setName($infoUserType->getName());
        $userTypeStorData->setStatus($infoUserType->getStatus());
        $userTypeStorData->setTimestamp($infoUserType->getTimestamp());
        list($insere, $idStyUserType) = StyUserTypeStor::save($userTypeStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoUserType->getId() > 0) {
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

  $dataSvc->addToResponse("ConfirmSaveUserType", $insere);
}

// Return response
$dataSvc->endOfService();

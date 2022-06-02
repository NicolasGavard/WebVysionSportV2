<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/Data/DistriXCodeTableWeightTypeNameData.php");
// Database Data
include(__DIR__ . "/Data/WeightTypeNameStorData.php");
include(__DIR__ . "/Data/WeightTypeStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/WeightTypeNameStor.php");
include(__DIR__ . "/Storage/WeightTypeStor.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

// SaveWeightType
if ($dataSvc->getMethodName() == "SaveWeightType") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoWeightType = new DistriXCodeTableWeightTypeData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoWeightType     = $dataSvc->getParameter("data");
      $weightTypeData     = DistriXSvcUtil::setData($infoWeightType, "WeightTypeStorData");
      $canSaveWeightType  = true;
      if ($infoWeightType->getId() == 0) {
        // Verify Code Exist
        list($weightTypeStor, $weightTypeStorInd) = WeightTypeStor::findByCode($weightTypeData, true, $dbConnection);
        if ($weightTypeStorInd > 0) {
          $canSaveWeightType          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoWeightType->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveWeightType) {
        $weightTypeStorData = new WeightTypeStorData();
        $weightTypeStorData->setId($infoWeightType->getId());
        $weightTypeStorData->setCode($infoWeightType->getCode());
        $weightTypeStorData->setElemState($infoWeightType->getElemState());
        $weightTypeStorData->setTimestamp($infoWeightType->getTimestamp());
        list($insere, $idWeightType) = WeightTypeStor::save($weightTypeStorData, $dbConnection);
        
        if ($insere) {
          $weightTypeNameStorData = new WeightTypeNameStorData();
          $weightTypeNameStorData->setId($infoWeightType->getId());
          $weightTypeNameStorData->setIdWeightType($infoWeightType->getIdWeightType());
          $weightTypeNameStorData->setIdLanguage($infoWeightType->getIdLanguage());
          $weightTypeNameStorData->setName($infoWeightType->getName());
          $weightTypeNameStorData->setDescription($infoWeightType->getDescription());
          $weightTypeNameStorData->setAbbreviation($infoWeightType->getAbbreviation());
          $weightTypeNameStorData->setElemState($infoWeightType->getElemState());
          $weightTypeNameStorData->setTimestamp($infoWeightType->getTimestamp());
          list($insere, $idWeightTypeName) = WeightTypeNameStor::save($weightTypeNameStorData, $dbConnection);
        }

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoWeightType->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "Login", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSave", $insere);
}

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/Data/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/Data/DistriXCodeTableNutritionalNameData.php");
// Database Data
include(__DIR__ . "/Data/NutritionalNameStorData.php");
include(__DIR__ . "/Data/NutritionalStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/NutritionalNameStor.php");
include(__DIR__ . "/Storage/NutritionalStor.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

// SaveNutritional
if ($dataSvc->getMethodName() == "SaveNutritional") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoNutritional = new DistriXCodeTableNutritionalData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoNutritional     = $dataSvc->getParameter("data");
      $nutritionalData     = DistriXSvcUtil::setData($infoNutritional, "NutritionalStorData");
      $canSaveNutritional  = true;
      if ($infoNutritional->getId() == 0) {
        // Verify Code Exist
        list($nutritionalStor, $nutritionalStorInd) = NutritionalStor::findByCode($nutritionalData, true, $dbConnection);
        if ($nutritionalStorInd > 0) {
          $canSaveNutritional          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoNutritional->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveNutritional) {
        $nutritionalStorData = new NutritionalStorData();
        $nutritionalStorData->setId($infoNutritional->getId());
        $nutritionalStorData->setCode($infoNutritional->getCode());
        $nutritionalStorData->setStatus($infoNutritional->getStatus());
        $nutritionalStorData->setTimestamp($infoNutritional->getTimestamp());
        list($insere, $idNutritional) = NutritionalStor::save($nutritionalStorData, $dbConnection);
        
        if ($insere) {
          $nutritionalNameStorData = new NutritionalNameStorData();
          $nutritionalNameStorData->setId($infoNutritional->getId());
          $nutritionalNameStorData->setIdNutritional($infoNutritional->getIdNutritional());
          $nutritionalNameStorData->setIdLanguage($infoNutritional->getIdLanguage());
          $nutritionalNameStorData->setName($infoNutritional->getName());
          $nutritionalNameStorData->setStatus($infoNutritional->getStatus());
          $nutritionalNameStorData->setTimestamp($infoNutritional->getTimestamp());
          list($insere, $idNutritionalName) = NutritionalNameStor::save($nutritionalNameStorData, $dbConnection);
        }

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoNutritional->getId() > 0) {
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

<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/Data/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/Data/DistriXCodeTableFoodCategoryNameData.php");
// Database Data
include(__DIR__ . "/Data/CategoryNameStorData.php");
include(__DIR__ . "/Data/CategoryStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/CategoryNameStor.php");
include(__DIR__ . "/Storage/CategoryStor.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

// SaveFoodCategory
if ($dataSvc->getMethodName() == "SaveFoodCategory") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoFoodCategory = new DistriXCodeTableFoodCategoryData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoFoodCategory     = $dataSvc->getParameter("data");
      $nutritionalData     = DistriXSvcUtil::setData($infoFoodCategory, "FoodCategoryStorData");
      $canSaveFoodCategory  = true;
      if ($infoFoodCategory->getId() == 0) {
        // Verify Code Exist
        list($nutritionalStor, $nutritionalStorInd) = CategoryStor::findByCode($nutritionalData, true, $dbConnection);
        if ($nutritionalStorInd > 0) {
          $canSaveFoodCategory          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoFoodCategory->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveFoodCategory) {
        $nutritionalStorData = new CategoryStorData();
        $nutritionalStorData->setId($infoFoodCategory->getId());
        $nutritionalStorData->setCode($infoFoodCategory->getCode());
        $nutritionalStorData->setStatus($infoFoodCategory->getStatus());
        $nutritionalStorData->setTimestamp($infoFoodCategory->getTimestamp());
        list($insere, $idFoodCategory) = CategoryStor::save($nutritionalStorData, $dbConnection);
        
        if ($insere) {
          $nutritionalNameStorData = new CategoryNameStorData();
          $nutritionalNameStorData->setId($infoFoodCategory->getId());
          $nutritionalNameStorData->setIdCategory($infoFoodCategory->getIdCategory());
          $nutritionalNameStorData->setIdLanguage($infoFoodCategory->getIdLanguage());
          $nutritionalNameStorData->setName($infoFoodCategory->getName());
          $nutritionalNameStorData->setStatus($infoFoodCategory->getStatus());
          $nutritionalNameStorData->setTimestamp($infoFoodCategory->getTimestamp());
          list($insere, $idFoodCategoryName) = CategoryNameStor::save($nutritionalNameStorData, $dbConnection);
        }

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoFoodCategory->getId() > 0) {
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

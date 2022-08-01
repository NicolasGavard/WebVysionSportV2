<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/Data/DistriXCodeTableFoodCategoryData.php");
// Database Data
include(__DIR__ . "/Data/CategoryStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/CategoryStor.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

// DelFoodCategory
if ($dataSvc->getMethodName() == "DelFoodCategory") {
  $dbConnection   = null;
  $errorData      = null;
  $insere         = false;
  $infoFoodCategory = new DistriXCodeTableFoodCategoryData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoFoodCategory = $dataSvc->getParameter("data");
      $scoreNutristor = CategoryStor::read($infoFoodCategory->getId(), $dbConnection);
      $insere         = CategoryStor::remove($scoreNutristor, $dbConnection);
      
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
    } else {
      $errorData = ApplicationErrorData::noBeginTransaction(1, 1);
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }

  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "DelFoodCategory", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSave", $insere);
}

// Return response
$dataSvc->endOfService();

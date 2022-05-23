<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/DietStor.php");
// STOR Data
include(__DIR__ . "/Data/DietStorData.php");
// DISTRIX DATA
include(__DIR__ . "/DistriXNutritionCurrentDietData.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";

// DelCurrentDiet
if ($dataSvc->getMethodName() == "DelCurrentDiet") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoCurrentDiet     = new DistriXNutritionCurrentDietData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoCurrentDiet     = $dataSvc->getParameter("data");
      $styCurrentDietStor  = DietStor::read($infoCurrentDiet->getId(), $dbConnection);
      $insere              = DietStor::remove($styCurrentDietStor, $dbConnection);
      
      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($infoCurrentDiet->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "DelCurrentDiet", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSave", $insere);
}

// Return response
$dataSvc->endOfService();

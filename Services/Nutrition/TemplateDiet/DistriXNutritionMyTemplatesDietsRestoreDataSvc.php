<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/DietTemplateStor.php");
// STOR Data
include(__DIR__ . "/Data/DietTemplateStorData.php");
// DISTRIX DATA
include(__DIR__ . "/Data/DistriXNutritionTemplateDietData.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";

// RestoreTemplateDiet
if ($dataSvc->getMethodName() == "RestoreTemplateDiet") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoTemplateDiet     = new DistriXNutritionTemplateDietData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoTemplateDiet             = $dataSvc->getParameter("data");
      $styTemplateDietTemplateStor  = DietTemplateStor::read($infoTemplateDiet->getId(), $dbConnection);
      $insere                       = DietTemplateStor::restore($styTemplateDietTemplateStor, $dbConnection);
      
      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($infoTemplateDiet->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "RestoreTemplateDiet", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSave", $insere);
}

// Return response
$dataSvc->endOfService();

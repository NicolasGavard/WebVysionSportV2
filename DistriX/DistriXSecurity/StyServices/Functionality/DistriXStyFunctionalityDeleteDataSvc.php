<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX STY Init
include(__DIR__.'/../Init/DataSvcInit.php');
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyFunctionalityData.php");
// Database Data
include(__DIR__ . "/Data/StyFunctionalityStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyFunctionalityStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// DelFunctionality
if ($dataSvc->getMethodName() == "DelFunctionality") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoFunctionality     = new DistriXStyFunctionalityData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoFunctionality      = $dataSvc->getParameter("data");
      $styFunctionalityStor   = StyFunctionalityStor::read($infoFunctionality->getId(), $dbConnection);
      $insere                 = StyFunctionalityStor::remove($styFunctionalityStor, $dbConnection);
      
      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($infoFunctionality->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "DelFunctionality", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSaveFunctionality", $insere);
}

// Return response
$dataSvc->endOfService();

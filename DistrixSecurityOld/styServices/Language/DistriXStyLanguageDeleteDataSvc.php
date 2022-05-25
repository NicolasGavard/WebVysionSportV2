<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyLanguageData.php");
// Database Data
include(__DIR__ . "/Data/StyLanguageStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyLanguageStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

// DelLanguage
if ($dataSvc->getMethodName() == "DelLanguage") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoLanguage     = new DistriXStyLanguageData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoLanguage     = $dataSvc->getParameter("data");
      $styLanguagestor  = StyLanguageStor::read($infoLanguage->getId(), $dbConnection);
      $insere           = StyLanguageStor::remove($styLanguagestor, $dbConnection);
      
      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($infoLanguage->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "DelLanguage", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSaveLanguage", $insere);
}

// Return response
$dataSvc->endOfService();

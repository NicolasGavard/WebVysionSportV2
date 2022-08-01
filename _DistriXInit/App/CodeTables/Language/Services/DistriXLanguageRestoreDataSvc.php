<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/LanguageStor.php");
// Database Data
include(__DIR__ . "/Data/LanguageStorData.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    list($data, $jsonError) = LanguageStorData::getJsonData($dataSvc->getParameter("data"));
    $languageStorData       = LanguageStor::read($data->getId(), $dbConnection);
    $insere                 = LanguageStor::restore($languageStorData, $dbConnection);
    
    if ($insere) {
      $dbConnection->commit();
    } else {
      $dbConnection->rollBack();
      $errorData = ApplicationErrorData::warningUpdateData(1, 1);
    }
  } else {
    $errorData = ApplicationErrorData::noBeginTransaction(1, 1);
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}

if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "RestoreLanguage", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ConfirmSave", $insere);

// Return response
$dataSvc->endOfService();

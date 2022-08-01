<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/MealTypeStorData.php");
  // Storage
  include(__DIR__ . "/Storage/MealTypeStor.php");
  
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      list($mealTypeStor, $jsonError) = MealTypeStorData::getJsonData($dataSvc->getParameter("data"));
      $insere = MealTypeStor::remove($mealTypeStor, $dbConnection);
      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($mealTypeStor->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "DelMealType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSave", $insere);

  // Return response
  $dataSvc->endOfService();
}
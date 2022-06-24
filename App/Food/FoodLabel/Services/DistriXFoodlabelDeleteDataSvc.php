<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/FoodLabelStorData.php");
// Storage
include(__DIR__ . "/Storage/FoodLabelStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    list($data, $jsonError) = FoodLabelStorData::getJsonData($dataSvc->getParameter("data"));
    $foodLabelStor = FoodLabelStor::read($data->getId(), $dbConnection);
    $insere         = FoodLabelStor::remove($foodLabelStor, $dbConnection);
    
    if ($insere) {
      $dbConnection->commit();
    } else {
      $dbConnection->rollBack();
      if ($infoFoodLabel->getId() > 0) {
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "DelFoodLabel", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ConfirmSave", $insere);


// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/DietStor.php");
// STOR Data
include(__DIR__ . "/Data/DietStorData.php");

$insere       = false;
$dietStorData = new DietStorData();

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    list($dietStorData, $jsonError) = DietStorData::getJsonData($dataSvc->getParameter("data"));
    $canSaveCurrentDiet  = true;
    if ($dietStorData->getId() == 0) {
      // Possibility to save datas
      $styCurrentDietStor = DietStor::findByIdUserCoachIdUserStudentIdDietTemplateDateStart($dietStorData, $dbConnection);
      if ($styCurrentDietStor->getId() > 0) {
        $canSaveCurrentDiet  = false;
        $distriXSvcErrorData = new DistriXSvcErrorData();
        $distriXSvcErrorData->setCode("400");
        $distriXSvcErrorData->setDefaultText("This diet is already in use");
        $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
        $errorData = $distriXSvcErrorData;
      }
    }

    if ($canSaveCurrentDiet) {
      list($insere, $idCurrentDiet) = DietStor::save($dietStorData, $dbConnection);

      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($dietStorData->getId() > 0) {
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ConfirmSaveCurrentDiet", $insere);
$dataSvc->addToResponse("idDiet", $idCurrentDiet);

// Return response
$dataSvc->endOfService();

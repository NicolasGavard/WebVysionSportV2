<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
    // Storage
    include(__DIR__ . "/Storage/DietTemplateStor.php");
    // STOR Data
    include(__DIR__ . "/Data/DietTemplateStorData.php");

  $dietTemplateStorData = new DietStorData();
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      list($dietTemplateStorData, $jsonError) = DietTemplateStorData::getJsonData($dataSvc->getParameter("data"));
      $canSaveTemplateDiet  = true;
      if ($dietTemplateStorData->getId() == 0) {
        // Possibility to save datas
        $styTemplateDietStor = DietTemplateStor::findByIdUserCoachNameDuration($dietTemplateStorData, $dbConnection);
        if ($styTemplateDietStor->getId() > 0) {
          $canSaveTemplateDiet  = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("This diet template is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveTemplateDiet) {
        list($insere, $idTemplateDiet) = DietStor::save($dietTemplateStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($dietTemplateStorData->getId() > 0) {
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

  $dataSvc->addToResponse("ConfirmSaveTemplateDiet", $insere);
}

// Return response
$dataSvc->endOfService();

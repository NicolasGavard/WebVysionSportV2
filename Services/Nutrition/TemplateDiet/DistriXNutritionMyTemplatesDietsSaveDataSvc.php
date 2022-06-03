<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/Init/DistriXTemplateDietInitDataSvc.php");
if ($dataSvc->isAuthorized()) {
  // SaveTemplateDiet
  if ($dataSvc->getMethodName() == "SaveTemplateDiet") {
    $dbConnection = null;
    $errorData    = null;
    $insere       = false;
    $dietTemplateStorData = new DietStorData();

    $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
    if (is_null($dbConnection->getError())) {
      if ($dbConnection->beginTransaction()) {
        list($dietTemplateStorData, $jsonError) = DietTemplateStorData::getJsonData($dataSvc->getParameter("data"));
        $canSaveTemplateDiet  = true;
        if ($dietTemplateStorData->getId() == 0) {
          // Possibility to save datas
          $styTemplateDietStor = DietTemplateStor::findByIdUserCoachIdUserStudentIdDietTemplateDateStart($dietTemplateStorData, $dbConnection);
          if ($styTemplateDietStor->getId() > 0) {
            $canSaveTemplateDiet  = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("This diet is already in use");
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
              $errorData = TemplateDietErrorData::warningUpdateData(1, 1);
            } else {
              $errorData = TemplateDietErrorData::warningInsertData(1, 1);
            }
          }
        }
      } else {
        $errorData = TemplateDietErrorData::noBeginTransaction(1, 1);
      }
    } else {
      $errorData = TemplateDietErrorData::noDatabaseConnection(1, 32);
    }

    if ($errorData != null) {
      $errorData->setTemplateDietModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
      $dataSvc->addErrorToResponse($errorData);
    }

    $dataSvc->addToResponse("ConfirmSaveTemplateDiet", $insere);
  }
}

// Return response
$dataSvc->endOfService();

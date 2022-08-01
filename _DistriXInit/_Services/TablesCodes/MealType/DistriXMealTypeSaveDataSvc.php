<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include(__DIR__ . "/Init/DistriXMealTypeInitDataSvc.php");
if ($dataSvc->isAuthorized()) {

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($mealTypeStorData, $jsonError) = MealTypeStorData::getJsonData($dataSvc->getParameter("data"));
    list($mealTypeNamesStorData, $jsonErrorName) = MealTypeNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

    if ($jsonError->getCode() == "") {
      if ($dbConnection->beginTransaction()) {
        $canSave = true;
        if ($mealTypeStorData->getId() == 0) {
          // Verify Code Exist
          $currentMealTypeStorData = MealTypeStor::findByCode($mealTypeStorData, $dbConnection);
          if ($currentMealTypeStorData->getId() > 0) {
            $canSave             = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("The Code " . $mealTypeStorData->getCode() . " is already in use");
            $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
            $errorData = $distriXSvcErrorData;
          }
        }
        if ($canSave) {
          list($insere, $idMealTypeStorData) = MealTypeStor::save($mealTypeStorData, $dbConnection);
          if ($insere) {
            foreach ($mealTypeNamesStorData as $mealTypeNameStorData) {
              $mealTypeNameStorData->setIdMealType($idMealTypeStorData);
              list($insere, $idMealTypeNameStorData) = MealTypeNameStor::save($mealTypeNameStorData, $dbConnection);
              if (!$insere) { break; }
            }
            if (!$insere) {
              // Error with MealTypeNames
            }
          } else {
            // Error with MealType
          }
          if ($insere) {
            $dbConnection->commit();
          } else {
            $dbConnection->rollBack();
            if ($mealTypeStorData->getId() > 0) {
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
      $errorData = ApplicationErrorData::warningInsertData(1, 1);
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }

  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveMealType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ConfirmSave", $insere);

  // Return response
  $dataSvc->endOfService();
}
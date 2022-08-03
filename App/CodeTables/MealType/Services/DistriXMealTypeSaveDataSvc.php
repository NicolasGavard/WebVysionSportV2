<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/MealTypeStorData.php");
  include(__DIR__ . "/Data/MealTypeNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/MealTypeStor.php");
  include(__DIR__ . "/Storage/MealTypeNameStor.php");
  
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($mealTypeStorData, $jsonError) = MealTypeStorData::getJsonData($dataSvc->getParameter("data"));
    list($mealTypeNamesStorData, $jsonErrorName) = MealTypeNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));
    if ($jsonError->getCode() == "") {
      if ($dbConnection->beginTransaction()) {
        $canSave = true;
        $currentMealTypeStorData = new MealTypeStorData();
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
        } else {
          // Verify no one has already modified the data
          $currentMealTypeStorData = MealTypeStor::read($mealTypeStorData->getId(), $dbConnection);
          if ($mealTypeStorData->getId() == $currentMealTypeStorData->getId() 
            && $mealTypeStorData->getTimestamp() != $currentMealTypeStorData->getTimestamp()) {
            $canSave = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("401");
            $distriXSvcErrorData->setDefaultText("The data of " . $mealTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
            $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
            $errorData = $distriXSvcErrorData;
          }
        }
        if ($canSave) {
          list($currentMealTypeStorData, $listNames) = MealTypeStor::readNames($mealTypeStorData->getId(), $dbConnection);
          if (($mealTypeStorData->getId() == $currentMealTypeStorData->getId() && $mealTypeStorData->getTimestamp() == $currentMealTypeStorData->getTimestamp())
          || ($mealTypeStorData->getId() != $currentMealTypeStorData->getId())) {
            list($insere, $idMealTypeStorData) = MealTypeStor::save($mealTypeStorData, $dbConnection);
            if (!empty($listNames)) {
              foreach ($listNames as $nameStorData) {
                $notFound = true;
                foreach ($mealTypeNamesStorData as $mealTypeNameStorData) {
                  $mealTypeNameStorData->setIdMealType($idMealTypeStorData);
                  if ($mealTypeNameStorData->getId() > 0 && $mealTypeNameStorData->getId() == $nameStorData->getId()) {
                    $notFound = false;
                    if ($mealTypeNameStorData->getTimestamp() != $nameStorData->getTimestamp()) {
                      $canSave = false;
                      $distriXSvcErrorData = new DistriXSvcErrorData();
                      $distriXSvcErrorData->setCode("402");
                      $distriXSvcErrorData->setDefaultText("The language data of " . $mealTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
                      $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
                      $errorData = $distriXSvcErrorData;
                      break;
                    }
                  }
                  list($insere, $idMealTypeNameStorData) = MealTypeNameStor::save($mealTypeNameStorData, $dbConnection);
                  if (!$insere) { break; }
                }
                if ($notFound) { // This language has been removed !
                    $insere = MealTypeNameStor::delete($nameStorData->getId(), $dbConnection);
                    if (!$insere) { break; }
                }
              }
            } else { // Currently no languages
              foreach ($mealTypeNamesStorData as $mealTypeNameStorData) {
                $mealTypeNameStorData->setIdMealType($idMealTypeStorData);
                list($insere, $idMealTypeNameStorData) = MealTypeNameStor::save($mealTypeNameStorData, $dbConnection);
                if (!$insere) { break; }
              }
            }
          }
        }
        if ($canSave) {
          if ($insere) {
            $dbConnection->commit();
            // $dbConnection->rollBack();
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
  $dataSvc->addToResponse("ConfirmSave", $insere && $canSave);
  // Return response
  $dataSvc->endOfService();
}
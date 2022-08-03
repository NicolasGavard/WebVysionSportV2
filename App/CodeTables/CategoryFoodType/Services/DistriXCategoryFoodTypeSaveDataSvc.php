<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/CategoryFoodTypeStorData.php");
  include(__DIR__ . "/Data/CategoryFoodTypeNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/CategoryFoodTypeStor.php");
  include(__DIR__ . "/Storage/CategoryFoodTypeNameStor.php");

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($categoryFoodTypeStorData, $jsonError) = CategoryFoodTypeStorData::getJsonData($dataSvc->getParameter("data"));
    list($categoryFoodTypeNamesStorData, $jsonErrorName) = CategoryFoodTypeNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

    if ($jsonError->getCode() == "") {
      if ($dbConnection->beginTransaction()) {
        $canSave = true;
        $currentCategoryFoodTypeStorData = new CategoryFoodTypeStorData();

        if ($categoryFoodTypeStorData->getId() == 0) {
          // Verify Code Exist
          $currentCategoryFoodTypeStorData = CategoryFoodTypeStor::findByCode($categoryFoodTypeStorData, $dbConnection);
          if ($currentCategoryFoodTypeStorData->getId() > 0) {
            $canSave             = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("The Code " . $categoryFoodTypeStorData->getCode() . " is already in use");
            $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
            $errorData = $distriXSvcErrorData;
          }
        } else {
          // Verify no one has already modified the data
          $currentCategoryFoodTypeStorData = CategoryFoodTypeStor::read($categoryFoodTypeStorData->getId(), $dbConnection);
          if ($categoryFoodTypeStorData->getId() == $currentCategoryFoodTypeStorData->getId() 
            && $categoryFoodTypeStorData->getTimestamp() != $currentCategoryFoodTypeStorData->getTimestamp()) {
            $canSave = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("401");
            $distriXSvcErrorData->setDefaultText("The data of " . $categoryFoodTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
            $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
            $errorData = $distriXSvcErrorData;
            }
        }
        if ($canSave) {
          list($currentCategoryFoodTypeStorData, $listNames) = CategoryFoodTypeStor::readNames($categoryFoodTypeStorData->getId(), $dbConnection);
          if (($categoryFoodTypeStorData->getId() == $currentCategoryFoodTypeStorData->getId() && $categoryFoodTypeStorData->getTimestamp() == $currentCategoryFoodTypeStorData->getTimestamp())
          || ($categoryFoodTypeStorData->getId() != $currentCategoryFoodTypeStorData->getId())) {
            list($insere, $idCategoryFoodTypeStorData) = CategoryFoodTypeStor::save($categoryFoodTypeStorData, $dbConnection);
            if (!empty($listNames)) {
              foreach ($listNames as $nameStorData) {
                $notFound = true;
                foreach ($categoryFoodTypeNamesStorData as $categoryFoodTypeNameStorData) {
                  $categoryFoodTypeNameStorData->setIdCategoryFoodType($idCategoryFoodTypeStorData);
                  if ($categoryFoodTypeNameStorData->getId() > 0 && $categoryFoodTypeNameStorData->getId() == $nameStorData->getId()) {
                    $notFound = false;
                    if ($categoryFoodTypeNameStorData->getTimestamp() != $nameStorData->getTimestamp()) {
                      $canSave = false;
                      $distriXSvcErrorData = new DistriXSvcErrorData();
                      $distriXSvcErrorData->setCode("402");
                      $distriXSvcErrorData->setDefaultText("The language data of " . $categoryFoodTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
                      $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
                      $errorData = $distriXSvcErrorData;
                      break;
                    }
                  }
                  list($insere, $idCategoryFoodTypeNameStorData) = CategoryFoodTypeNameStor::save($categoryFoodTypeNameStorData, $dbConnection);
                  if (!$insere) { break; }
                }
                if ($notFound) { // This language has been removed !
                    $insere = CategoryFoodTypeNameStor::delete($nameStorData->getId(), $dbConnection);
                    if (!$insere) { break; }
                }
              }
            } else { // Currently no languages
              foreach ($categoryFoodTypeNamesStorData as $categoryFoodTypeNameStorData) {
                $categoryFoodTypeNameStorData->setIdCategoryFoodType($idCategoryFoodTypeStorData);
                list($insere, $idCategoryFoodTypeNameStorData) = CategoryFoodTypeNameStor::save($categoryFoodTypeNameStorData, $dbConnection);
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
            if ($categoryFoodTypeStorData->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveCategoryFoodType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ConfirmSave", $insere && $canSave);

  // Return response
  $dataSvc->endOfService();
}
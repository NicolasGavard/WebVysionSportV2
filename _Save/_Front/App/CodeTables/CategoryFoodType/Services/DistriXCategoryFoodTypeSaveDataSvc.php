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
    list($categoryFoodTypeStorData, $jsonError)           = CategoryFoodTypeStorData::getJsonData($dataSvc->getParameter("data"));
    list($categoryFoodTypeNamesStorData, $jsonErrorName)  = CategoryFoodTypeNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

    if ($jsonError->getCode() == "") {
      if ($dbConnection->beginTransaction()) {
        $canSave = true;
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
        }
        if ($canSave) {
          list($insere, $idCategoryFoodTypeStorData) = CategoryFoodTypeStor::save($categoryFoodTypeStorData, $dbConnection);
          if ($insere) {
            foreach ($categoryFoodTypeNamesStorData as $categoryFoodTypeNameStorData) {
              $categoryFoodTypeNameStorData->setIdCategoryFoodType($idCategoryFoodTypeStorData);
              list($insere, $idCategoryFoodTypeNameStorData) = CategoryFoodTypeNameStor::save($categoryFoodTypeNameStorData, $dbConnection);
              if (!$insere) { break; }
            }
            if (!$insere) {
              // Error with CategoryFoodTypeNames
            }
          } else {
            // Error with CategoryFoodType
          }
          if ($insere) {
            $dbConnection->commit();
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
  $dataSvc->addToResponse("ConfirmSave", $insere);

  // Return response
  $dataSvc->endOfService();
}
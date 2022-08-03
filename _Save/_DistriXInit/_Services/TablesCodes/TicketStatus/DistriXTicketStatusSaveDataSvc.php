<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/FoodTypeStorData.php");
  include(__DIR__ . "/Data/FoodTypeNameStorData.php");
  // Storage
  include(__DIR__ . "/Storage/FoodTypeStor.php");
  include(__DIR__ . "/Storage/FoodTypeNameStor.php");

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($foodTypeStorData, $jsonError) = FoodTypeStorData::getJsonData($dataSvc->getParameter("data"));
    list($foodTypeNamesStorData, $jsonErrorName) = FoodTypeNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

// print_r($foodTypeStorData);
// print_r($foodTypeNamesStorData);

    if ($jsonError->getCode() == "") {
      if ($dbConnection->beginTransaction()) {
        $canSave = true;
        $currentFoodTypeStorData = new FoodTypeStorData();

        if ($foodTypeStorData->getId() == 0) {
          // Verify Code Exist
          $currentFoodTypeStorData = FoodTypeStor::findByIndCode($foodTypeStorData, $dbConnection);
          if ($currentFoodTypeStorData->getId() > 0) {
            $canSave = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("The Code " . $foodTypeStorData->getCode() . " is already in use");
            $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
            $errorData = $distriXSvcErrorData;
          }
        } else {
          // Verify no one has already modified the data
          $currentFoodTypeStorData = FoodTypeStor::read($foodTypeStorData->getId(), $dbConnection);
          if ($foodTypeStorData->getId() == $currentFoodTypeStorData->getId() 
           && $foodTypeStorData->getTimestamp() != $currentFoodTypeStorData->getTimestamp()) {
            $canSave = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("401");
            $distriXSvcErrorData->setDefaultText("The data of " . $foodTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
            $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
            $errorData = $distriXSvcErrorData;
           }
        }
        if ($canSave) {
          $currentFoodTypeStorData = FoodTypeStor::read($foodTypeStorData->getId(), $dbConnection);
          if (($foodTypeStorData->getId() == $currentFoodTypeStorData->getId() && $foodTypeStorData->getTimestamp() == $currentFoodTypeStorData->getTimestamp())
          || ($foodTypeStorData->getId() != $currentFoodTypeStorData->getId())) {
            list($insere, $idFoodTypeStorData) = FoodTypeStor::save($foodTypeStorData, $dbConnection);
            foreach ($foodTypeNamesStorData as $foodTypeNameStorData) {
              $foodTypeNameStorData->setIdFoodType($idFoodTypeStorData);
              if ($foodTypeNameStorData->getId() > 0) {
                $currentFoodTypeNameStorData = FoodTypeNameStor::read($foodTypeNameStorData->getId(), $dbConnection);
                if ($foodTypeNameStorData->getId() == $currentFoodTypeNameStorData->getId() 
                && $foodTypeNameStorData->getTimestamp() != $currentFoodTypeNameStorData->getTimestamp()) {
                 $canSave = false;
                 $distriXSvcErrorData = new DistriXSvcErrorData();
                 $distriXSvcErrorData->setCode("402");
                 $distriXSvcErrorData->setDefaultText("The language data of " . $foodTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
                 $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
                 $errorData = $distriXSvcErrorData;
                 break;
                }
              }
              list($insere, $idFoodTypeNameStorData) = FoodTypeNameStor::save($foodTypeNameStorData, $dbConnection);
              if (!$insere) { break; }
            }
          }
        }
        if ($canSave) {
          if ($insere) {
            $dbConnection->commit();
          } else {
            $dbConnection->rollBack();
            if ($foodTypeStorData->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveFoodType", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ConfirmSave", $insere && $canSave);

  // Return response
  $dataSvc->endOfService();
}
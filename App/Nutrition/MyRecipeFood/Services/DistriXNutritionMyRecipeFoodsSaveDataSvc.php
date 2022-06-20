<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Storage
  include(__DIR__ . "/Storage/RecipeFoodStor.php");
  // STOR Data
  include(__DIR__ . "/Data/RecipeFoodStorData.php");

  $recipeStorData = new RecipeFoodStorData();
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      list($recipeStorData, $jsonError) = RecipeFoodStorData::getJsonData($dataSvc->getParameter("data"));
      $canSaveMyRecipeFood  = true;
      if ($recipeStorData->getId() == 0) {
        // Possibility to save datas
        $styMyRecipeFoodStor = RecipeFoodStor::findByIdRecipeIdFood($recipeStorData, $dbConnection);
        if ($styMyRecipeFoodStor->getId() > 0) {
          $canSaveMyRecipeFood  = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("This food is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveMyRecipeFood) {
        list($insere, $idMyRecipeFood) = RecipeFoodStor::save($recipeStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($recipeStorData->getId() > 0) {
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

  $dataSvc->addToResponse("ConfirmSave", $insere);
}

// Return response
$dataSvc->endOfService();

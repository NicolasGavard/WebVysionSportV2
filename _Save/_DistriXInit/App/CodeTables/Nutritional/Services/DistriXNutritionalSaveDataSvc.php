<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/NutritionalStor.php");
// Database Data
include(__DIR__ . "/Data/NutritionalStorData.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    list($data, $jsonError) = NutritionalStorData::getJsonData($dataSvc->getParameter("data"));
    $canSaveNutritional  = true;
    if ($data->getId() == 0) {
      // Verify Code Exist
      list($nutritionalStor, $nutritionalStorInd) = NutritionalStor::findByCode($data, true, $dbConnection);
      if ($nutritionalStorInd > 0) {
        $canSaveNutritional          = false;
        $distriXSvcErrorData = new DistriXSvcErrorData();
        $distriXSvcErrorData->setCode("400");
        $distriXSvcErrorData->setDefaultText("The Code " . $data->getCode() . " is already in use");
        $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
        $errorData = $distriXSvcErrorData;
      }
    }

    if ($canSaveNutritional) {
      $nutritionalStorData = NutritionalStor::read($data->getId(), $dbConnection);
      $nutritionalStorData->setId($data->getId());
      $nutritionalStorData->setCode(strtoupper(trim(DistriXSvcUtil::remove_accents($data->getName()))));
      $nutritionalStorData->setName($data->getName());
      $nutritionalStorData->setElemState($data->getElemState());
      $nutritionalStorData->setTimestamp($data->getTimestamp());
      list($insere, $idNutritional) = NutritionalStor::save($nutritionalStorData, $dbConnection);

      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($data->getId() > 0) {
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveNutritional", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ConfirmSave", $insere);

// Return response
$dataSvc->endOfService();

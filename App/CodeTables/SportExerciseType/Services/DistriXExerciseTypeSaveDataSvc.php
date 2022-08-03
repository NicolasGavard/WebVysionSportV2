<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
// Database Data
include(__DIR__ . "/Data/ExerciseTypeStorData.php");
include(__DIR__ . "/Data/ExerciseTypeNameStorData.php");
// Storage
include(__DIR__ . "/Storage/ExerciseTypeStor.php");
include(__DIR__ . "/Storage/ExerciseTypeNameStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($exerciseTypeStorData, $jsonError) = ExerciseTypeStorData::getJsonData($dataSvc->getParameter("data"));
  list($exerciseTypeNamesStorData, $jsonErrorName) = ExerciseTypeNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

  if ($jsonError->getCode() == "") {
    if ($dbConnection->beginTransaction()) {
      $canSave = true;
      $currentExerciseTypeStorData = new ExerciseTypeStorData();

      if ($exerciseTypeStorData->getId() == 0) {
        // Verify Code Exist
        $currentExerciseTypeStorData = ExerciseTypeStor::findByIndCode($exerciseTypeStorData, $dbConnection);
        if ($currentExerciseTypeStorData->getId() > 0) {
          $canSave = false;
          $distriXSvcErrorData = new ApplicationErrorData("400", 1, 1);
          $distriXSvcErrorData->setDefaultText("The Code " . $exerciseTypeStorData->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      } else {
        // Verify no one has already modified the data
        $currentExerciseTypeStorData = ExerciseTypeStor::read($exerciseTypeStorData->getId(), $dbConnection);
        if ($exerciseTypeStorData->getId() == $currentExerciseTypeStorData->getId() 
          && $exerciseTypeStorData->getTimestamp() != $currentExerciseTypeStorData->getTimestamp()) {
          $canSave = false;
          $distriXSvcErrorData = new ApplicationErrorData("401", 1, 1);
          $distriXSvcErrorData->setDefaultText("The data of " . $exerciseTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
          $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
          $errorData = $distriXSvcErrorData;
          }
      }
      if ($canSave) {
        list($currentExerciseTypeStorData, $listNames) = ExerciseTypeStor::readNames($exerciseTypeStorData->getId(), $dbConnection);
        if (($exerciseTypeStorData->getId() == $currentExerciseTypeStorData->getId() && $exerciseTypeStorData->getTimestamp() == $currentExerciseTypeStorData->getTimestamp())
        || ($exerciseTypeStorData->getId() != $currentExerciseTypeStorData->getId())) {
          list($insere, $idExerciseTypeStorData) = ExerciseTypeStor::save($exerciseTypeStorData, $dbConnection);
          if (!empty($listNames)) {
            foreach ($listNames as $nameStorData) {
              $notFound = true;
              foreach ($exerciseTypeNamesStorData as $exerciseTypeNameStorData) {
                $exerciseTypeNameStorData->setIdExerciseType($idExerciseTypeStorData);
                if ($exerciseTypeNameStorData->getId() > 0 && $exerciseTypeNameStorData->getId() == $nameStorData->getId()) {
                  $notFound = false;
                  if ($exerciseTypeNameStorData->getTimestamp() != $nameStorData->getTimestamp()) {
                    $canSave = false;
                    $distriXSvcErrorData = new ApplicationErrorData("402", 1, 1);
                    $distriXSvcErrorData->setDefaultText("The language data of " . $exerciseTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
                    $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
                    $errorData = $distriXSvcErrorData;
                    break;
                  }
                }
                list($insere, $idExerciseTypeNameStorData) = ExerciseTypeNameStor::save($exerciseTypeNameStorData, $dbConnection);
                if (!$insere) { break; }
              }
              if ($notFound) { // This language has been removed !
                  $insere = ExerciseTypeNameStor::delete($nameStorData->getId(), $dbConnection);
                  if (!$insere) { break; }
              }
            }
          } else { // Currently no languages
            foreach ($exerciseTypeNamesStorData as $exerciseTypeNameStorData) {
              $exerciseTypeNameStorData->setIdExerciseType($idExerciseTypeStorData);
              list($insere, $idExerciseTypeNameStorData) = ExerciseTypeNameStor::save($exerciseTypeNameStorData, $dbConnection);
              if (!$insere) { break; }
            }
          }
        }
      }
      if ($canSave) {
        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($exerciseTypeStorData->getId() > 0) {
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveExerciseType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ConfirmSave", $insere && $canSave);

// Return response
$dataSvc->endOfService();
}
<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/ExerciseStor.php");
// STOR Data
include(__DIR__ . "/Data/ExerciseStorData.php");

$insere       = false;
$exerciseStorData = new ExerciseStorData();

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    list($exerciseStorData, $jsonError) = ExerciseStorData::getJsonData($dataSvc->getParameter("data"));
    $canSaveCurrentExercise  = true;
    if ($exerciseStorData->getId() == 0) {
      // Possibility to save datas
      $styCurrentExerciseStor = ExerciseStor::findByIdUserCoachIdUserStudentIdExerciseTemplateDateStart($exerciseStorData, $dbConnection);
      if ($styCurrentExerciseStor->getId() > 0) {
        $canSaveCurrentExercise  = false;
        $distriXSvcErrorData = new DistriXSvcErrorData();
        $distriXSvcErrorData->setCode("400");
        $distriXSvcErrorData->setDefaultText("This exercise is already in use");
        $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
        $errorData = $distriXSvcErrorData;
      }
    }

    if ($canSaveCurrentExercise) {
      list($insere, $idCurrentExercise) = ExerciseStor::save($exerciseStorData, $dbConnection);

      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($exerciseStorData->getId() > 0) {
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

$dataSvc->addToResponse("ConfirmSaveCurrentExercise", $insere);
$dataSvc->addToResponse("idExercise", $idCurrentExercise);

// Return response
$dataSvc->endOfService();

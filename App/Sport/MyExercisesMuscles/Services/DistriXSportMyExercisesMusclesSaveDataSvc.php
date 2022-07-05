<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Storage
include(__DIR__ . "/Storage/ExerciseMuscleStor.php");
// STOR Data
include(__DIR__ . "/Data/ExerciseMuscleStorData.php");

$insere       = false;
$exerciseMuscleStorData = new ExerciseMuscleStorData();

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    list($exerciseMuscleStorData, $jsonError) = ExerciseMuscleStorData::getJsonData($dataSvc->getParameter("data"));
    $canSaveCurrentExerciseMuscle  = true;
    if ($exerciseMuscleStorData->getId() == 0) {
      // Possibility to save datas
      $styCurrentExerciseMuscleStor = ExerciseMuscleStor::findByIdUserCoachIdUserStudentIdExerciseMuscleTemplateDateStart($exerciseMuscleStorData, $dbConnection);
      if ($styCurrentExerciseMuscleStor->getId() > 0) {
        $canSaveCurrentExerciseMuscle  = false;
        $distriXSvcErrorData = new DistriXSvcErrorData();
        $distriXSvcErrorData->setCode("400");
        $distriXSvcErrorData->setDefaultText("This exerciseMuscle is already in use");
        $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
        $errorData = $distriXSvcErrorData;
      }
    }

    if ($canSaveCurrentExerciseMuscle) {
      list($insere, $idCurrentExerciseMuscle) = ExerciseMuscleStor::save($exerciseMuscleStorData, $dbConnection);

      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($exerciseMuscleStorData->getId() > 0) {
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

$dataSvc->addToResponse("ConfirmSaveCurrentExerciseMuscle", $insere);
$dataSvc->addToResponse("idExerciseMuscle", $idCurrentExerciseMuscle);

// Return response
$dataSvc->endOfService();

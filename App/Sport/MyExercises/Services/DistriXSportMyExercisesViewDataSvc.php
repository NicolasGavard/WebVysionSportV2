<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Cdn Location
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnFolderConst.php");
// Storage
include(__DIR__ . "/Storage/ExerciseStor.php");
// STOR Data
include(__DIR__ . "/Data/ExerciseStorData.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($exerciseStorData, $jsonError)   = ExerciseStorData::getJsonData($dataSvc->getParameter("data"));
  $exerciseStor                         = ExerciseStor::read($exerciseStorData->getId(), $dbConnection);

  if ($exerciseStor->getLinkToPictureInternalPoster() != '') {
    $urlPicture   = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_EXERCISES . '/' . $exerciseStor->getLinkToPictureInternalPoster();
    if ($exerciseStor->getLinkToPictureInternalPoster() == '') {
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_EXERCISES . '/default.png';
    }
    $exerciseStor->setLinkToPictureInternalPoster($urlPicture);

    $urlPicture   = DISTRIX_CDN_URL_MOVIES . DISTRIX_CDN_FOLDER_EXERCISES . '/' . $exerciseStor->getLinkToPictureInternal();
    $exerciseStor->setLinkToPictureInternal($urlPicture);
  } else {
    if ($exerciseStor->getLinkToPictureExternalId() == '') {
      $urlPicture   = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_EXERCISES . '/' . $exerciseStor->getLinkToPictureInternalPoster();
      if ($exerciseStor->getLinkToPictureInternalPoster() == '') {
        $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_EXERCISES . '/default.png';
      }
      $exerciseStor->setLinkToPictureInternalPoster($urlPicture);

      $urlPicture   = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_EXERCISES . '/' . $exerciseStor->getLinkToPictureExternal();
      if ($exerciseStor->getLinkToPictureExternal() == '') {
        $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_EXERCISES . '/default.png';
      }
      $exerciseStor->setLinkToPictureExternal($urlPicture);
    }
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ViewMyCurrentExercise", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewMyCurrentExercise", $exerciseStor);

// Return response
$dataSvc->endOfService();

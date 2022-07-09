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

  if ($exerciseStor->getIsAudio()) {
    if ($exerciseStor->getPlayerType() == '' && $exerciseStor->getPlayerId() == '') {
      $urlMedia       = DISTRIX_CDN_URL_AUDIOS . DISTRIX_CDN_FOLDER_EXERCISES . '/' . $exerciseStor->getLinkToMedia();
      $medias_headers = get_headers($urlMedia);
      if ($exerciseStor->getLinkToMedia() == '' || !$medias_headers || $medias_headers[0] == 'HTTP/1.1 404 Not Found') {
        $exerciseStor->setLinkToMedia('');
      } else {
        $exerciseStor->setLinkToMedia($urlMedia);
      }
    }
  } else if ($exerciseStor->getIsVideo()) {
    if ($exerciseStor->getPlayerType() == '' && $exerciseStor->getPlayerId() == '') {
      // Picture
      $urlPicture       = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_EXERCISES . '/' . $exerciseStor->getLinkToPicture();
      $medias_headers = get_headers($urlPicture);
      if ($exerciseStor->getLinkToPicture() == '' || !$medias_headers || $medias_headers[0] == 'HTTP/1.1 404 Not Found') {
        $exerciseStor->setLinkToPicture('');
      } else {
        $exerciseStor->setLinkToPicture($urlPicture);
      }
      
      // Media
      $urlMedia       = DISTRIX_CDN_URL_MOVIES . DISTRIX_CDN_FOLDER_EXERCISES . '/' . $exerciseStor->getLinkToMedia();
      $medias_headers = get_headers($urlMedia);
      if ($exerciseStor->getLinkToMedia() == '' || !$medias_headers || $medias_headers[0] == 'HTTP/1.1 404 Not Found') {
        $exerciseStor->setLinkToMedia('');
      } else {
        $exerciseStor->setLinkToMedia($urlMedia);
      }
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

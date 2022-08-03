<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/ScoreNovaStorData.php");
// Storage
include(__DIR__ . "/Storage/ScoreNovaStor.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Cdn Location
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnFolderConst.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    list($data, $jsonError) = ScoreNovaStorData::getJsonData($dataSvc->getParameter("data"));
    $canSaveScoreNova  = true;
    if ($data->getId() == 0) {
      // Verify Code Exist
      list($scoresNovaStor, $scoresNovaStorInd) = ScoreNovaStor::findByNumber($data, true, $dbConnection);
      if ($scoresNovaStorInd > 0) {
        $canSaveScoreNova     = false;
        $distriXSvcErrorData = new DistriXSvcErrorData();
        $distriXSvcErrorData->setCode("400");
        $distriXSvcErrorData->setDefaultText("The Code " . $data->getCode() . " is already in use");
        $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
        $errorData = $distriXSvcErrorData;
      }
    }

    if ($canSaveScoreNova) {
      $scoreNovaStorData = new ScoreNovaStorData();
      $scoreNovaStorData->setId($data->getId());
      $scoreNovaStorData->setNumber($data->getNumber());
      $scoreNovaStorData->setColor($data->getColor());
      $scoreNovaStorData->setDescription($data->getDescription());
      $scoreNovaStorData->setElemState($data->getElemState());
      $scoreNovaStorData->setTimestamp($data->getTimestamp());
      
      if ($data->getLinkToPicture() != "") {
        $image          = file_get_contents($data->getLinkToPicture());
        $imageInfo      = getimagesizefromstring($image);
        $imageExtension = str_replace("image/", "", $imageInfo['mime']);

        if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
          $imageName    = DistriXSvcUtil::generateRandomText(50);
          $imageFile    = substr($data->getLinkToPicture(), strpos($data->getLinkToPicture(), ",") + 1);

          $cdn          = new DistriXCdn();
          $data         = new DistriXCdnData();
          $data->setImageGroup(DISTRIX_CDN_GROUP_IMAGES);
          $data->setImageFamily(DISTRIX_CDN_FOLDER_CODE_TABLES);
          $data->setImageName($imageName);
          $data->setImageType($imageInfo['mime']);
          $data->setImage($imageFile);
          $added              = $cdn->addImage($data);
          $confirmSavePicture = $cdn->sendToCdn();

          if ($confirmSavePicture) {
            $scoreNovaStorData->setLinkToPicture($imageName);
            $scoreNovaStorData->setSize($imageInfo['bits']);
            $scoreNovaStorData->setType($imageInfo['mime']);
          } else {
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("Error Import file " . $imageExtension);
            $distriXSvcErrorData->setText("ERROR_IMPORT_IMAGE");
          }
        } else {
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("Bad extension " . $imageExtension);
          $distriXSvcErrorData->setText("BAD_IMAGE_EXTENSION");
        }
      } else {
        if($data->getId() > 0){
          $scoreNovaStor = ScoreNovaStor::read($data->getId(), $dbConnection);
          $scoreNovaStorData->setLinkToPicture($scoreNovaStor->getLinkToPicture());
          $scoreNovaStorData->setSize($scoreNovaStor->getSize());
          $scoreNovaStorData->setType($scoreNovaStor->getType());
        }
      }
      list($insere, $idStyScoresNova) = ScoreNovaStor::save($scoreNovaStorData, $dbConnection);

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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveNovaScore", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ConfirmSave", $insere);

// Return response
$dataSvc->endOfService();

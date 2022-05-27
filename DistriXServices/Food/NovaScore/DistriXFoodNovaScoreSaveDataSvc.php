<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/Data/DistriXFoodScoreNovaData.php");
// Database Data
include(__DIR__ . "/Data/ScoreNovaStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/ScoreNovaStor.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

// SaveNovaScore
if ($dataSvc->getMethodName() == "SaveNovaScore") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoScoreNova = new DistriXFoodScoreNovaData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoScoreNova     = $dataSvc->getParameter("data");
      $scoreNovaData     = DistriXSvcUtil::setData($infoScoreNova, "ScoreNovaStorData");
      $canSaveScoreNova  = true;
      if ($infoScoreNova->getId() == 0) {
        // Verify Code Exist
        list($scoresNovaStor, $scoresNovaStorInd) = ScoreNovaStor::findByLetter($scoreNovaData, true, $dbConnection);
        if ($scoresNovaStorInd > 0) {
          $canSaveScoreNova     = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoScoreNova->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveScoreNova) {
        $scoreNovaStorData = new ScoreNovaStorData();
        $scoreNovaStorData->setId($infoScoreNova->getId());
        $scoreNovaStorData->setLetter($infoScoreNova->getLetter());
        $scoreNovaStorData->setColor($infoScoreNova->getColor());
        $scoreNovaStorData->setDescription($infoScoreNova->getDescription());
        $scoreNovaStorData->setElemState($infoScoreNova->getElemState());
        $scoreNovaStorData->setTimestamp($infoScoreNova->getTimestamp());
        
        if ($infoScoreNova->getLinkToPicture() != "") {
          $image          = file_get_contents($infoScoreNova->getLinkToPicture());
          $imageInfo      = getimagesizefromstring($image);
          $imageExtension = str_replace("image/", "", $imageInfo['mime']);

          if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
            $imageName    = DistriXSvcUtil::generateRandomText(50);
            $imageFile    = substr($infoScoreNova->getLinkToPicture(), strpos($infoScoreNova->getLinkToPicture(), ",") + 1);

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
          if($infoScoreNova->getId() > 0){
            $scoreNovaStor = ScoreNovaStor::read($infoScoreNova->getId(), $dbConnection);
            $scoreNovaData = DistriXSvcUtil::setData($scoreNovaStor, "DistriXFoodScoreNovaData");
            $scoreNovaStorData->setLinkToPicture($scoreNovaData->getLinkToPicture());
            $scoreNovaStorData->setSize($scoreNovaData->getSize());
            $scoreNovaStorData->setType($scoreNovaData->getType());
          }
        }
        list($insere, $idStyScoresNova) = ScoreNovaStor::save($scoreNovaStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoScoreNova->getId() > 0) {
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
}

// Return response
$dataSvc->endOfService();

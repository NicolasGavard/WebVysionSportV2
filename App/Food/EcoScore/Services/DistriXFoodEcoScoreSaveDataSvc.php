<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/ScoreEcoStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/ScoreEcoStor.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

// SaveEcoScore
if ($dataSvc->getMethodName() == "SaveEcoScore") {
  $insere       = false;
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      list($data, $jsonError) = ScoreEcoStorData::getJsonData($dataSvc->getParameter("data"));
      $canSaveScoreEco  = true;
      if ($data->getId() == 0) {
        // Verify Code Exist
        list($scoresEcoStor, $scoresEcoStorInd) = ScoreEcoStor::findByLetter($data, true, $dbConnection);
        if ($scoresEcoStorInd > 0) {
          $canSaveScoreEco     = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $data->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveScoreEco) {
        $scoreEcoStorData = new ScoreEcoStorData();
        $scoreEcoStorData->setId($data->getId());
        $scoreEcoStorData->setLetter($data->getLetter());
        $scoreEcoStorData->setColor($data->getColor());
        $scoreEcoStorData->setDescription($data->getLetter());
        $scoreEcoStorData->setElemState($data->getElemState());
        $scoreEcoStorData->setTimestamp($data->getTimestamp());
        
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
              $scoreEcoStorData->setLinkToPicture($imageName);
              $scoreEcoStorData->setSize($imageInfo['bits']);
              $scoreEcoStorData->setType($imageInfo['mime']);
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
            $scoreEcoStor = ScoreEcoStor::read($data->getId(), $dbConnection);
            $scoreEcoStorData->setLinkToPicture($scoreEcoStor->getLinkToPicture());
            $scoreEcoStorData->setSize($scoreEcoStor->getSize());
            $scoreEcoStorData->setType($scoreEcoStor->getType());
          }
        }
        list($insere, $idStyScoresEco) = ScoreEcoStor::save($scoreEcoStorData, $dbConnection);

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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveEcoScore", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSave", $insere);
}

// Return response
$dataSvc->endOfService();

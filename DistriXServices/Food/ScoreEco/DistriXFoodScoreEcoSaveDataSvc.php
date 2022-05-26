<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/Data/DistriXFoodScoreEcoData.php");
// Database Data
include(__DIR__ . "/Data/ScoreEcoStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/ScoreEcoStor.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

// SaveScoreEco
if ($dataSvc->getMethodName() == "SaveScoreEco") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoScoreEco = new DistriXFoodScoreEcoData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoScoreEco     = $dataSvc->getParameter("data");
      $scoreEcoData     = DistriXSvcUtil::setData($infoScoreEco, "ScoreEcoStorData");
      $canSaveScoreEco  = true;
      if ($infoScoreEco->getId() == 0) {
        // Verify Code Exist
        list($scoresEcoStor, $scoresEcoStorInd) = ScoreEcoStor::findByLetter($scoreEcoData, true, $dbConnection);
        if ($scoresEcoStorInd > 0) {
          $canSaveScoreEco          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoScoreEco->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveScoreEco) {
        $scoreEcoStorData = new ScoreEcoStorData();
        $scoreEcoStorData->setId($infoScoreEco->getId());
        $scoreEcoStorData->setLetter($infoScoreEco->getLetter());
        $scoreEcoStorData->setColor($infoScoreEco->getColor());
        $scoreEcoStorData->setDescription($infoScoreEco->getDescription());
        $scoreEcoStorData->setStatut($infoScoreEco->getStatut());
        $scoreEcoStorData->setTimestamp($infoScoreEco->getTimestamp());
        
        if ($infoScoreEco->getLinkToPicture() != "") {
          $image          = file_get_contents($infoScoreEco->getLinkToPicture());
          $imageInfo      = getimagesizefromstring($image);
          $imageExtension = str_replace("image/", "", $imageInfo['mime']);

          if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
            $imageName    = DistriXSvcUtil::generateRandomText(50);
            $imageFile    = substr($infoScoreEco->getLinkToPicture(), strpos($infoScoreEco->getLinkToPicture(), ",") + 1);

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
          if($infoScoreEco->getId() > 0){
            $scoreEcoStor = ScoreEcoStor::read($infoScoreEco->getId(), $dbConnection);
            $scoreEcoData = DistriXSvcUtil::setData($scoreEcoStor, "DistriXFoodScoreEcoData");
            $scoreEcoStorData->setLinkToPicture($scoreEcoData->getLinkToPicture());
            $scoreEcoStorData->setSize($scoreEcoData->getSize());
            $scoreEcoStorData->setType($scoreEcoData->getType());
          }
        }
        list($insere, $idStyScoresEco) = ScoreEcoStor::save($scoreEcoStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoScoreEco->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "Login", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSave", $insere);
}

// Return response
$dataSvc->endOfService();

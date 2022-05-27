<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/Data/DistriXFoodScoreNutriData.php");
// Database Data
include(__DIR__ . "/Data/ScoreNutriStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/ScoreNutriStor.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

// SaveNutriScore
if ($dataSvc->getMethodName() == "SaveNutriScore") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoScoreNutri = new DistriXFoodScoreNutriData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoScoreNutri     = $dataSvc->getParameter("data");
      $scoreNutriData     = DistriXSvcUtil::setData($infoScoreNutri, "ScoreNutriStorData");
      $canSaveScoreNutri  = true;
      if ($infoScoreNutri->getId() == 0) {
        // Verify Code Exist
        list($scoresNutriStor, $scoresNutriStorInd) = ScoreNutriStor::findByLetter($scoreNutriData, true, $dbConnection);
        if ($scoresNutriStorInd > 0) {
          $canSaveScoreNutri     = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoScoreNutri->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveScoreNutri) {
        $scoreNutriStorData = new ScoreNutriStorData();
        $scoreNutriStorData->setId($infoScoreNutri->getId());
        $scoreNutriStorData->setLetter($infoScoreNutri->getLetter());
        $scoreNutriStorData->setColor($infoScoreNutri->getColor());
        $scoreNutriStorData->setDescription($infoScoreNutri->getDescription());
        $scoreNutriStorData->setElemState($infoScoreNutri->getElemState());
        $scoreNutriStorData->setTimestamp($infoScoreNutri->getTimestamp());
        
        if ($infoScoreNutri->getLinkToPicture() != "") {
          $image          = file_get_contents($infoScoreNutri->getLinkToPicture());
          $imageInfo      = getimagesizefromstring($image);
          $imageExtension = str_replace("image/", "", $imageInfo['mime']);

          if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
            $imageName    = DistriXSvcUtil::generateRandomText(50);
            $imageFile    = substr($infoScoreNutri->getLinkToPicture(), strpos($infoScoreNutri->getLinkToPicture(), ",") + 1);

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
              $scoreNutriStorData->setLinkToPicture($imageName);
              $scoreNutriStorData->setSize($imageInfo['bits']);
              $scoreNutriStorData->setType($imageInfo['mime']);
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
          if($infoScoreNutri->getId() > 0){
            $scoreNutriStor = ScoreNutriStor::read($infoScoreNutri->getId(), $dbConnection);
            $scoreNutriData = DistriXSvcUtil::setData($scoreNutriStor, "DistriXFoodScoreNutriData");
            $scoreNutriStorData->setLinkToPicture($scoreNutriData->getLinkToPicture());
            $scoreNutriStorData->setSize($scoreNutriData->getSize());
            $scoreNutriStorData->setType($scoreNutriData->getType());
          }
        }
        list($insere, $idStyScoresNutri) = ScoreNutriStor::save($scoreNutriStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoScoreNutri->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveNutriScore", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSave", $insere);
}

// Return response
$dataSvc->endOfService();

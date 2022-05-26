<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/LabelStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/LabelStor.php");
// Stor Data
include(__DIR__ . "/Data/DistriXFoodLabelData.php");
// Distrix CDN
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";

// SaveLabel
if ($dataSvc->getMethodName() == "SaveLabel") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoLabel     = new DistriXFoodLabelData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoLabel     = $dataSvc->getParameter("data");
      $LabelStorData = DistriXSvcUtil::setData($infoLabel, "LabelStorData");
      $canSaveLabel  = true;
      if ($infoLabel->getId() == 0) {
        // Verify Code Exist
        list($styLabelStor, $styLabelStorInd) = LabelStor::findByCode($LabelStorData, true, $dbConnection);
        if ($styLabelStorInd > 0) {
          $canSaveLabel          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoLabel->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveLabel) {
        $LabelStorData = new LabelStorData();
        $LabelStorData->setId($infoLabel->getId());
        $LabelStorData->setCode($infoLabel->getCode());
        $LabelStorData->setName($infoLabel->getName());
        $LabelStorData->setStatut($infoLabel->getStatut());
        $LabelStorData->setTimestamp($infoLabel->getTimestamp());
        
        if ($infoLabel->getLinkToPicture() != "" && $infoLabel->getLinkToPicture() != $LabelStorData->getLinkToPicture()) {
          $image          = file_get_contents($infoLabel->getLinkToPicture());
          $imageInfo      = getimagesizefromstring($image);
          $imageExtension = str_replace("image/", "", $imageInfo['mime']);

          if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
            $imageName    = DistriXSvcUtil::generateRandomText(50);
            $imageFile    = substr($infoLabel->getLinkToPicture(), strpos($infoLabel->getLinkToPicture(), ",") + 1);

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
              $LabelStorData->setLinkToPicture($imageName);
              $LabelStorData->setSize($imageInfo['bits']);
              $LabelStorData->setType($imageInfo['mime']);
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
          $LabelStorData->setLinkToPicture($LabelStorData->getLinkToPicture());
          $LabelStorData->setSize($LabelStorData->getSize());
          $LabelStorData->setType($LabelStorData->getType());
        }
        list($insere, $idLabel) = LabelStor::save($LabelStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoLabel->getId() > 0) {
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

  $dataSvc->addToResponse("ConfirmSaveLabel", $insere);
}

// Return response
$dataSvc->endOfService();

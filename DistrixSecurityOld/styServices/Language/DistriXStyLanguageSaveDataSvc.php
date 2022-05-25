<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyLanguageData.php");
// Database Data
include(__DIR__ . "/Data/StyLanguageStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyLanguageStor.php");
// Distrix CDN
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// SaveLanguage
if ($dataSvc->getMethodName() == "SaveLanguage") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoLanguage     = new DistriXStyLanguageData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoLanguage     = $dataSvc->getParameter("data");
      $LanguageStorData = DistriXSvcUtil::setData($infoLanguage, "StyLanguageStorData");
      $canSaveLanguage  = true;
      if ($infoLanguage->getId() == 0) {
        // Verify Code Exist
        list($styLanguageStor, $styLanguageStorInd) = StyLanguageStor::findByIndCode($LanguageStorData, true, $dbConnection);
        if ($styLanguageStorInd > 0) {
          $canSaveLanguage          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoLanguage->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveLanguage) {
        $LanguageStorData = new StyLanguageStorData();
        $LanguageStorData->setId($infoLanguage->getId());
        $LanguageStorData->setCode($infoLanguage->getCode());
        $LanguageStorData->setDescription($infoLanguage->getDescription());
        $LanguageStorData->setStatus($infoLanguage->getStatus());
        $LanguageStorData->setTimestamp($infoLanguage->getTimestamp());
        
        if ($infoLanguage->getLinkToPicture() != "" && $infoLanguage->getLinkToPicture() != $LanguageStorData->getLinkToPicture()) {
          $image          = file_get_contents($infoLanguage->getLinkToPicture());
          $imageInfo      = getimagesizefromstring($image);
          $imageExtension = str_replace("image/", "", $imageInfo['mime']);

          if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
            $imageName    = DistriXSvcUtil::generateRandomText(50);
            $imageFile    = substr($infoLanguage->getLinkToPicture(), strpos($infoLanguage->getLinkToPicture(), ",") + 1);

            $cdn          = new DistriXCdn();
            $data         = new DistriXCdnData();
            $data->setImageGroup(DISTRIX_CDN_GROUP_IMAGES);
            $data->setImageFamily(DISTRIX_CDN_FOLDER_LANGUAGES);
            $data->setImageName($imageName);
            $data->setImageType($imageInfo['mime']);
            $data->setImage($imageFile);
            $added              = $cdn->addImage($data);
            $confirmSavePicture = $cdn->sendToCdn();

            if ($confirmSavePicture) {
              $LanguageStorData->setLinkToPicture($imageName);
              $LanguageStorData->setSize($imageInfo['bits']);
              $LanguageStorData->setType($imageInfo['mime']);
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
          $LanguageStorData->setLinkToPicture($LanguageStorData->getLinkToPicture());
          $LanguageStorData->setSize($LanguageStorData->getSize());
          $LanguageStorData->setType($LanguageStorData->getType());
        }
        list($insere, $idStyLanguage) = StyLanguageStor::save($LanguageStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoLanguage->getId() > 0) {
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

  $dataSvc->addToResponse("ConfirmSaveLanguage", $insere);
}

// Return response
$dataSvc->endOfService();

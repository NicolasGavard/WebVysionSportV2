<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/BrandStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/BrandStor.php");
// Stor Data
include(__DIR__ . "/Data/DistriXFoodBrandData.php");
// Distrix CDN
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";

// SaveBrand
if ($dataSvc->getMethodName() == "SaveBrand") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoBrand     = new DistriXFoodBrandData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoBrand     = $dataSvc->getParameter("data");
      $BrandStorData = DistriXSvcUtil::setData($infoBrand, "BrandStorData");
      $canSaveBrand  = true;
      if ($infoBrand->getId() == 0) {
        // Verify Code Exist
        list($styBrandStor, $styBrandStorInd) = BrandStor::findByCode($BrandStorData, true, $dbConnection);
        if ($styBrandStorInd > 0) {
          $canSaveBrand          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoBrand->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveBrand) {
        $BrandStorData = new BrandStorData();
        $BrandStorData->setId($infoBrand->getId());
        $BrandStorData->setCode(trim(DistriXSvcUtil::remove_accents($infoBrand->getName())));
        $BrandStorData->setName($infoBrand->getName());
        $BrandStorData->setStatus($infoBrand->getStatus());
        $BrandStorData->setTimestamp($infoBrand->getTimestamp());
        
        if ($infoBrand->getLinkToPicture() != "" && $infoBrand->getLinkToPicture() != $BrandStorData->getLinkToPicture()) {
          $image          = file_get_contents($infoBrand->getLinkToPicture());
          $imageInfo      = getimagesizefromstring($image);
          $imageExtension = str_replace("image/", "", $imageInfo['mime']);

          if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
            $imageName    = DistriXSvcUtil::generateRandomText(50);
            $imageFile    = substr($infoBrand->getLinkToPicture(), strpos($infoBrand->getLinkToPicture(), ",") + 1);

            $cdn          = new DistriXCdn();
            $data         = new DistriXCdnData();
            $data->setImageGroup(DISTRIX_CDN_GROUP_IMAGES);
            $data->setImageFamily(DISTRIX_CDN_FOLDER_FOOD);
            $data->setImageName($imageName);
            $data->setImageType($imageInfo['mime']);
            $data->setImage($imageFile);
            $added              = $cdn->addImage($data);
            $confirmSavePicture = $cdn->sendToCdn();

            if ($confirmSavePicture) {
              $BrandStorData->setLinkToPicture($imageName);
              $BrandStorData->setSize($imageInfo['bits']);
              $BrandStorData->setType($imageInfo['mime']);
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
          $BrandStorData->setLinkToPicture($BrandStorData->getLinkToPicture());
          $BrandStorData->setSize($BrandStorData->getSize());
          $BrandStorData->setType($BrandStorData->getType());
        }
        list($insere, $idBrand) = BrandStor::save($BrandStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoBrand->getId() > 0) {
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

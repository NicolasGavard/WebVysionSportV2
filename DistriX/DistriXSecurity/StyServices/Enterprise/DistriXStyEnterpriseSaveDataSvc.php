<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyEnterpriseData.php");
// Database Data
include(__DIR__ . "/Data/StyEnterpriseStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyEnterpriseStor.php");
// Distrix CDN
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// SaveEnterprise
if ($dataSvc->getMethodName() == "SaveEnterprise") {
  $dbConnection     = null;
  $errorData        = null;
  $insere           = false;
  $idStyEnterprise  = 0;
  $infoEnterprise   = new DistriXStyEnterpriseData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoEnterprise     = $dataSvc->getParameter("data");
      $enterpriseStorData = DistriXSvcUtil::setData($infoEnterprise, "StyEnterpriseStorData");
      if ($infoEnterprise->getCode() == "") {
        $nameEnterprise = str_replace(' ', '_', $infoEnterprise->getName());
        $codeEnterprise = DistriXSvcUtil::remove_accents($nameEnterprise);
        $codeEnterprise = strtoupper($codeEnterprise);
      } else {
        $codeEnterprise = $infoEnterprise->getCode();
      }
      $enterpriseStorData->setCode($codeEnterprise);

      $canSaveEnterprise    = true;
      if ($infoEnterprise->getId() == 0) {
        // Verify Code Exist
        $styEnterpriseStor = StyEnterpriseStor::findByCode($enterpriseStorData, $dbConnection);
        if ($styEnterpriseStor->getId() > 0 && $styEnterpriseStor->getEmail() == $infoEnterprise->getEmail()) {
          $canSaveEnterprise    = false;
          $distriXSvcErrorData  = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The enterprise " . $styEnterpriseStor->getName() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveEnterprise) {
        $enterpriseStorData = new StyEnterpriseStorData();
        $enterpriseStorData->setId($infoEnterprise->getId());
        $enterpriseStorData->setCode($codeEnterprise);
        $enterpriseStorData->setName($infoEnterprise->getName());
        $enterpriseStorData->setEmail($infoEnterprise->getEmail());
        $enterpriseStorData->setPhone($infoEnterprise->getPhone());
        $enterpriseStorData->setMobile($infoEnterprise->getMobile());
        $enterpriseStorData->setCo($infoEnterprise->getCo());
        $enterpriseStorData->setStreet($infoEnterprise->getStreet());
        $enterpriseStorData->setZipCode($infoEnterprise->getZipCode());
        $enterpriseStorData->setCity($infoEnterprise->getCity());
        $enterpriseStorData->setLogoImageHtmlName($infoEnterprise->getLogoImageHtmlName());
        $enterpriseStorData->setLogoImageName($infoEnterprise->getLogoImageName());
        $enterpriseStorData->setLogoSize($infoEnterprise->getLogoSize());
        $enterpriseStorData->setLogoType($infoEnterprise->getLogoType());
        $enterpriseStorData->setIdRegion($infoEnterprise->getIdRegion());
        $enterpriseStorData->setIdCountry($infoEnterprise->getIdCountry());
        $enterpriseStorData->setIdLanguage($infoEnterprise->getIdLanguage());
        $enterpriseStorData->setIdUserManager($infoEnterprise->getIdUserManager());
        $enterpriseStorData->setIdStyEnterpriseParent($infoEnterprise->getIdStyEnterpriseParent());
        $enterpriseStorData->setStatus($infoEnterprise->getStatut());
        $enterpriseStorData->setTimestamp($infoEnterprise->getTimestamp());

        if ($infoEnterprise->getLinkToPicture() != "" && $infoEnterprise->getLinkToPicture() != $styUserStor->getLinkToPicture()) {
          $image          = file_get_contents($infoEnterprise->getLinkToPicture());
          $imageInfo      = getimagesizefromstring($image);
          $imageExtension = str_replace("image/", "", $imageInfo['mime']);

          if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
            $imageHtmlName= $infoEnterprise->getId() . '-' . $infoEnterprise->getName() . '-' . $infoEnterprise->getFirstName() . '.' . $imageExtension;
            $imageName    = DistriXSvcUtil::generateRandomText(50);
            $imageFile    = substr($infoEnterprise->getLinkToPicture(), strpos($infoEnterprise->getLinkToPicture(), ",") + 1);

            $cdn          = new DistriXCdn();
            $data         = new DistriXCdnData();
            $data->setImageGroup(DISTRIX_CDN_GROUP_IMAGES);
            $data->setImageFamily(DISTRIX_CDN_FOLDER_ENTERPRISE);
            $data->setImageName($imageName);
            $data->setImageType($imageInfo['mime']);
            $data->setImage($imageFile);
            $added              = $cdn->addImage($data);
            $confirmSavePicture = $cdn->sendToCdn();

            if ($confirmSavePicture) {
              $enterpriseStorData->setLogoImageHtmlName($imageHtmlName);
              $enterpriseStorData->setLogoImageName($imageName);
              $enterpriseStorData->setLogoSize($imageInfo['bits']);
              $enterpriseStorData->setLogoType($imageInfo['mime']);
            }
          } else {
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("Bad extension " . $imageExtension);
            $distriXSvcErrorData->setText("BAD_IMAGE_EXTENSION");
          }
        } else {
          $enterpriseStorData->setLogoImageHtmlName($infoEnterprise->getLogoImageHtmlName());
          $enterpriseStorData->setLogoImageName($infoEnterprise->getLinkToPicture());
          $enterpriseStorData->setLogoSize($infoEnterprise->getLogoSize());
          $enterpriseStorData->setLogoType($infoEnterprise->getLogoType());
        }
        list($insere, $idStyEnterprise) = StyEnterpriseStor::save($enterpriseStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoEnterprise->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "SaveEnterprise", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSaveEnterprise", $insere);
  $dataSvc->addToResponse("idStyEnterprise", $idStyEnterprise);
}

// Return response
$dataSvc->endOfService();

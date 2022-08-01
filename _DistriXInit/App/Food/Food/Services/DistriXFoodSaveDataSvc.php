<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/FoodStorData.php");
// Storage
include(__DIR__ . "/Storage/FoodStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    $infoFood     = $dataSvc->getParameter("data");
    $foodStorData = DistriXSvcUtil::setData($infoFood, "FoodStorData");
    $canSaveFood  = true;
    if ($infoFood->getId() == 0) {
      // Verify Code Exist
      $foodStorData = FoodStor::findByIdFoodIdType($foodStorData, $dbConnection);
      if ($foodStorData->getId() > 0) {
        $canSaveFood          = false;
        if ($foodStorData->getElemState() == 0){
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The  " . $infoFood->get() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;  
        } else {
          $canSaveFood  = true;
          $foodData     = DistriXSvcUtil::setData($foodStorData, "FoodStorData");
          $insere             = FoodStor::restore($foodData, $dbConnection);
          $infoFood->setId($foodStorData->getId());
        }
      }
    }

    if ($canSaveFood) {
      $foodStorData = new FoodStorData();
      $foodStorData->setId($id);
      $foodStorData->setIdBrand($idBrand);
      $foodStorData->setIdScoreNutri($idScoreNutri);
      $foodStorData->setIdScoreNova($idScoreNova);
      $foodStorData->setIdScoreEco($idScoreEco);
      $foodStorData->setCode($code);
      $foodStorData->setName($name);
      $foodStorData->setDescription($description);
      $foodStorData->setElemState($elemstate);
      $foodStorData->setTimestamp($timestamp);
      
      
      $foodStorData->setId($infoFood->getId());
      $foodStorData->setIdFood($infoFood->getIdFood());
      $foodStorData->setIdType($infoFood->getIdType());
      $foodStorData->set($infoFood->get());
      $foodStorData->setElemState($infoFood->getElemState());
      $foodStorData->setTimestamp($infoFood->getTimestamp());
      
      if ($infoFood->getLinkToPicture() != "" && $infoFood->getLinkToPicture() != $foodStorData->getLinkToPicture()) {
        $image          = file_get_contents($infoFood->getLinkToPicture());
        $imageInfo      = getimagesizefromstring($image);
        $imageExtension = str_replace("image/", "", $imageInfo['mime']);

        if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
          $imageName    = DistriXSvcUtil::generateRandomText(50);
          $imageFile    = substr($infoFood->getLinkToPicture(), strpos($infoFood->getLinkToPicture(), ",") + 1);

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
            $foodStorData->setLinkToPicture($imageName);
            $foodStorData->setSize($imageInfo['bits']);
            $foodStorData->setType($imageInfo['mime']);
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
        $foodStorData->setLinkToPicture($foodStorData->getLinkToPicture());
        $foodStorData->setSize($foodStorData->getSize());
        $foodStorData->setType($foodStorData->getType());
      }
      list($insere, $idFood) = FoodStor::save($foodStorData, $dbConnection);

      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($infoFood->getId() > 0) {
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

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/FoodWeightStorData.php");
// Storage
include(__DIR__ . "/Storage/FoodWeightStor.php");
// DISTRIX CDN
include(__DIR__ . "/../../../../DistriX/DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../../DistriX/DistriXCdn/Const/DistriXCdnFolderConst.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if ($dbConnection->beginTransaction()) {
    list($data, $jsonError) = FoodWeightStorData::getJsonData($dataSvc->getParameter("data"));
    $canSaveFoodWeight  = true;
    if ($data->getId() == 0) {
      // Verify Code Exist
      $foodWeightStorData = FoodWeightStor::findByIdFoodIdWeightTypeWeight($foodWeightStorData, $dbConnection);
      if ($foodWeightStorData->getId() > 0) {
        $canSaveFoodWeight          = false;
        if ($foodWeightStorData->getElemState() == 0){
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Weight " . $data->getWeight() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;  
        } else {
          $canSaveFoodWeight  = true;
          $foodWeightData     = DistriXSvcUtil::setData($foodWeightStorData, "FoodWeightStorData");
          $insere             = FoodWeightStor::restore($foodWeightData, $dbConnection);
          $data->setId($foodWeightStorData->getId());
        }
      }
    }

    if ($canSaveFoodWeight) {
      $foodWeightStorData = new FoodWeightStorData();
      $foodWeightStorData->setId($data->getId());
      $foodWeightStorData->setIdFood($data->getIdFood());
      $foodWeightStorData->setIdWeightType($data->getIdWeightType());
      $foodWeightStorData->setWeight($data->getWeight());
      $foodWeightStorData->setElemState($data->getElemState());
      $foodWeightStorData->setTimestamp($data->getTimestamp());
      
      if ($data->getLinkToPicture() != "" && $data->getLinkToPicture() != $foodWeightStorData->getLinkToPicture()) {
        $image          = file_get_contents($data->getLinkToPicture());
        $imageInfo      = getimagesizefromstring($image);
        $imageExtension = str_replace("image/", "", $imageInfo['mime']);

        if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
          $imageName    = DistriXSvcUtil::generateRandomText(50);
          $imageFile    = substr($data->getLinkToPicture(), strpos($data->getLinkToPicture(), ",") + 1);

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
            $foodWeightStorData->setLinkToPicture($imageName);
            $foodWeightStorData->setSize($imageInfo['bits']);
            $foodWeightStorData->setType($imageInfo['mime']);
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
        $foodWeightStorData->setLinkToPicture($foodWeightStorData->getLinkToPicture());
        $foodWeightStorData->setSize($foodWeightStorData->getSize());
        $foodWeightStorData->setType($foodWeightStorData->getType());
      }
      list($insere, $idFoodWeight) = FoodWeightStor::save($foodWeightStorData, $dbConnection);

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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "Login", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ConfirmSave", $insere);

// Return response
$dataSvc->endOfService();

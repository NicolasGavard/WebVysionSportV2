<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/DistriXFoodWeightData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/FoodWeightStor.php");
// Stor Data
include(__DIR__ . "/Data/FoodWeightStorData.php");
// Distrix CDN
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";

// SaveFoodWeight
if ($dataSvc->getMethodName() == "SaveFoodWeight") {
  $dbConnection   = null;
  $errorData      = null;
  $insere         = false;
  $infoFoodWeight = new DistriXFoodWeightData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoFoodWeight     = $dataSvc->getParameter("data");
      $foodWeightStorData = DistriXSvcUtil::setData($infoFoodWeight, "FoodWeightStorData");
      $canSaveFoodWeight  = true;
      if ($infoFoodWeight->getId() == 0) {
        // Verify Code Exist
        $foodWeightStorData = FoodWeightStor::findByIdFoodIdWeightTypeWeight($foodWeightStorData, $dbConnection);
        if ($foodWeightStorData->getId() > 0) {
          $canSaveFoodWeight          = false;
          if ($foodWeightStorData->getElemState() == 0){
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("The Weight " . $infoFoodWeight->getWeight() . " is already in use");
            $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
            $errorData = $distriXSvcErrorData;  
          } else {
            $canSaveFoodWeight  = true;
            $foodWeightData     = DistriXSvcUtil::setData($foodWeightStorData, "FoodWeightStorData");
            $insere             = FoodWeightStor::restore($foodWeightData, $dbConnection);
            $infoFoodWeight->setId($foodWeightStorData->getId());
          }
        }
      }

      if ($canSaveFoodWeight) {
        $foodWeightStorData = new FoodWeightStorData();
        $foodWeightStorData->setId($infoFoodWeight->getId());
        $foodWeightStorData->setIdFood($infoFoodWeight->getIdFood());
        $foodWeightStorData->setIdWeightType($infoFoodWeight->getIdWeightType());
        $foodWeightStorData->setWeight($infoFoodWeight->getWeight());
        $foodWeightStorData->setElemState($infoFoodWeight->getElemState());
        $foodWeightStorData->setTimestamp($infoFoodWeight->getTimestamp());
        
        if ($infoFoodWeight->getLinkToPicture() != "" && $infoFoodWeight->getLinkToPicture() != $foodWeightStorData->getLinkToPicture()) {
          $image          = file_get_contents($infoFoodWeight->getLinkToPicture());
          $imageInfo      = getimagesizefromstring($image);
          $imageExtension = str_replace("image/", "", $imageInfo['mime']);

          if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
            $imageName    = DistriXSvcUtil::generateRandomText(50);
            $imageFile    = substr($infoFoodWeight->getLinkToPicture(), strpos($infoFoodWeight->getLinkToPicture(), ",") + 1);

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
          if ($infoFoodWeight->getId() > 0) {
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

<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/../../../GlobalData/DistriXGeneralIdData.php");
include(__DIR__ . "/Data/DistriXFoodFoodData.php");
include(__DIR__ . "/Data/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/Data/DistriXCodeTableFoodCategoryNameData.php");
include(__DIR__ . "/Data/DistriXCodeTableNutritionalData.php");
include(__DIR__ . "/Data/DistriXCodeTableNutritionalNameData.php");
include(__DIR__ . "/Data/DistriXCodeTableWeightTypeData.php");
include(__DIR__ . "/Data/DistriXCodeTableWeightTypeNameData.php");
include(__DIR__ . "/Data/DistriXFoodBrandData.php");
include(__DIR__ . "/Data/DistriXFoodLabelData.php");
include(__DIR__ . "/Data/DistriXFoodNutritionalData.php");
include(__DIR__ . "/Data/DistriXFoodScoreEcoData.php");
include(__DIR__ . "/Data/DistriXFoodScoreNovaData.php");
include(__DIR__ . "/Data/DistriXFoodScoreNutriData.php");
include(__DIR__ . "/Data/DistriXFoodWeightData.php");
// Database Data
include(__DIR__ . "/Data/FoodCategoryStorData.php");
include(__DIR__ . "/Data/FoodLabelStorData.php");
include(__DIR__ . "/Data/FoodNameStorData.php");
include(__DIR__ . "/Data/FoodNutritionalStorData.php");
include(__DIR__ . "/Data/FoodStorData.php");
include(__DIR__ . "/Data/FoodWeightStorData.php");

include(__DIR__ . "/Data/BrandStorData.php");
include(__DIR__ . "/Data/LabelStorData.php");
include(__DIR__ . "/Data/CategoryNameStorData.php");
include(__DIR__ . "/Data/NutritionalNameStorData.php");
include(__DIR__ . "/Data/WeightTypeNameStorData.php");
include(__DIR__ . "/Data/ScoreEcoStorData.php");
include(__DIR__ . "/Data/ScoreNovaStorData.php");
include(__DIR__ . "/Data/ScoreNutriStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/FoodCategoryStor.php");
include(__DIR__ . "/Storage/FoodLabelStor.php");
include(__DIR__ . "/Storage/FoodNameStor.php");
include(__DIR__ . "/Storage/FoodNutritionalStor.php");
include(__DIR__ . "/Storage/FoodStor.php");
include(__DIR__ . "/Storage/FoodWeightStor.php");

include(__DIR__ . "/Storage/BrandStor.php");
include(__DIR__ . "/Storage/LabelStor.php");
include(__DIR__ . "/Storage/CategoryNameStor.php");
include(__DIR__ . "/Storage/NutritionalNameStor.php");
include(__DIR__ . "/Storage/WeightTypeNameStor.php");
include(__DIR__ . "/Storage/ScoreEcoStor.php");
include(__DIR__ . "/Storage/ScoreNovaStor.php");
include(__DIR__ . "/Storage/ScoreNutriStor.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$foods        = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $dataLanguage = $dataSvc->getParameter("dataLanguage");
  $dataFood     = $dataSvc->getParameter("dataFood");
  $foodStorData = DistriXSvcUtil::setData($dataFood, "FoodStorData");

// list($data, $jsonError) = ScoreEcoStorData::getJsonData($dataSvc->getParameter("data"));

  list($foodStor, $foodStorInd) = FoodStor::findByDatas($foodStorData, false, $dbConnection);
  foreach ($foodStor as $food) {
    $foodCategories   = [];
    $foodLabels       = [];
    $foodNutritionals = [];
    $foodWeights      = [];
    $weightsName      = [];
    
    $weightTypeNameStorData = new WeightTypeNameStorData();
    $weightTypeNameStorData->setIdLanguage($dataLanguage->getId());
    list($weightTypeNameStor,$weightTypeNameStorInd) = WeightTypeNameStor::findByLanguage($weightTypeNameStorData, false, $dbConnection);
    foreach ($weightTypeNameStor as $weightTypeName) {
      $distriXCodeTableWeightTypeNameData = new DistriXCodeTableWeightTypeNameData();
      $distriXCodeTableWeightTypeNameData->setId($weightTypeName->getId());
      $distriXCodeTableWeightTypeNameData->setIdWeightType($weightTypeName->getIdWeightType());
      $distriXCodeTableWeightTypeNameData->setIdLanguage($weightTypeName->getIdLanguage());
      $distriXCodeTableWeightTypeNameData->setName($weightTypeName->getName());
      $distriXCodeTableWeightTypeNameData->setAbbreviation($weightTypeName->getAbbreviation());
      $distriXCodeTableWeightTypeNameData->setTimestamp($weightTypeName->getTimestamp());
      $weightsName[] = $distriXCodeTableWeightTypeNameData;
    }
    
    $distriXFoodFoodData  = new DistriXFoodFoodData();
    $distriXFoodFoodData->setId($food->getId());
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                                   FoodBrand                                                          //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $distriXFoodFoodData->setIdBrand($food->getIdBrand());
    $brandStorData        = BrandStor::read($food->getIdBrand(), $dbConnection);
    $distriXFoodFoodData->setNameBrand($brandStorData->getName());
    
    $urlPicture           = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/' . $brandStorData->getLinkToPicture();
    $pictures_headers     = get_headers($urlPicture);
    if ($brandStorData->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $brandStorData->getLinkToPicture() == '') {
      $urlPicture         = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/default.png';
    }
    $distriXFoodFoodData->setPictureBrand($urlPicture);
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                                FoodScoreNutri                                                        //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $distriXFoodFoodData->setIdScoreNutri($food->getIdScoreNutri());
    $ScoreNutriStorData   = ScoreNutriStor::read($food->getIdScoreNutri(), $dbConnection);
    $urlPicture           = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/' . $ScoreNutriStorData->getLinkToPicture();
    $pictures_headers     = get_headers($urlPicture);
    if ($ScoreNutriStorData->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $ScoreNutriStorData->getLinkToPicture() == '') {
      $urlPicture         = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/default.png';
    }
    $distriXFoodFoodData->setPictureScoreNutri($urlPicture);
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                                FoodScoreNova                                                         //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $distriXFoodFoodData->setIdScoreNova($food->getIdScoreNova());
    $ScoreNovaStorData   = ScoreNovaStor::read($food->getIdScoreNova(), $dbConnection);
    $urlPicture           = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/' . $ScoreNovaStorData->getLinkToPicture();
    $pictures_headers     = get_headers($urlPicture);
    if ($ScoreNovaStorData->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $ScoreNovaStorData->getLinkToPicture() == '') {
      $urlPicture         = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/default.png';
    }
    $distriXFoodFoodData->setPictureScoreNova($urlPicture);
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                                FoodScoreEco                                                          //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $distriXFoodFoodData->setIdScoreEco($food->getIdScoreEco());
    $ScoreEcoStorData   = ScoreEcoStor::read($food->getIdScoreEco(), $dbConnection);
    $urlPicture           = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/' . $ScoreEcoStorData->getLinkToPicture();
    $pictures_headers     = get_headers($urlPicture);
    if ($ScoreEcoStorData->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $ScoreEcoStorData->getLinkToPicture() == '') {
      $urlPicture         = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/default.png';
    }
    $distriXFoodFoodData->setPictureScoreEco($urlPicture);

    $distriXFoodFoodData->setCode($food->getCode());
    $distriXFoodFoodData->setDescription($food->getDescription());

    $foodNameStorData = new FoodNameStorData();
    $foodNameStorData->setIdFood($food->getId());
    $foodNameStorData->setIdLanguage($dataLanguage->getId());
    $foodNameStor     = FoodNameStor::findByIdFoodIdLanguage($foodNameStorData, $dbConnection);
    $distriXFoodFoodData->setName($foodNameStor->getName());
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                                 FoodCategories                                                       //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $foodCategoryStorData = new FoodCategoryStorData();
    $foodCategoryStorData->setIdFood($food->getId());
    list($foodCategoryStor, $foodCategoryStorInd) = FoodCategoryStor::findByIdFood($foodCategoryStorData, false, $dbConnection);
    foreach ($foodCategoryStor as $foodCategory) {
      $categoryNameStorData = new CategoryNameStorData();
      $categoryNameStorData->setIdCategory($foodCategory->getIdCategory());
      $categoryNameStorData->setIdLanguage($dataLanguage->getId());
      $categoryNameStor = CategoryNameStor::findByIdCategoryIdlanguage($categoryNameStorData, $dbConnection);
      
      $distriXCodeTableFoodCategoryNameData = new DistriXCodeTableFoodCategoryNameData();
      $distriXCodeTableFoodCategoryNameData->setId($foodCategory->getId());
      $distriXCodeTableFoodCategoryNameData->setIdCategory($foodCategory->getIdCategory());
      $distriXCodeTableFoodCategoryNameData->setIdLanguage($categoryNameStor->getIdLanguage());
      $distriXCodeTableFoodCategoryNameData->setName($categoryNameStor->getName());
      $distriXCodeTableFoodCategoryNameData->setStatus($foodCategory->getStatus());
      $distriXCodeTableFoodCategoryNameData->setTimestamp($foodCategory->getTimestamp());
      $foodCategories[] = $distriXCodeTableFoodCategoryNameData;
    }
    $distriXFoodFoodData->setFoodCategories($foodCategories);
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                                  FoodLabels                                                          //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $foodLabelStorData = new FoodLabelStorData();
    $foodLabelStorData->setIdFood($food->getId());
    list($foodLabelStor, $foodLabelStorInd) = FoodLabelStor::findByIdFood($foodLabelStorData, false, $dbConnection);
    foreach ($foodLabelStor as $foodLabel) {
      $labelStor            = LabelStor::read($foodLabel->getIdLabel(), $dbConnection);
      $distriXFoodLabelData = DistriXSvcUtil::setData($labelStor, "DistriXFoodLabelData");
      $urlPicture           = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/' . $distriXFoodLabelData->getLinkToPicture();
      $pictures_headers     = get_headers($urlPicture);
      if ($distriXFoodLabelData->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $distriXFoodLabelData->getLinkToPicture() == '') {
        $urlPicture         = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_CODE_TABLES . '/default.png';
      }
      $distriXFoodLabelData->setLinkToPicture($urlPicture);
      $foodLabels[]         = $distriXFoodLabelData;
    }
    $distriXFoodFoodData->setFoodLabels($foodLabels);
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                                 FoodNutritionals                                                     //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $foodNutritionalStorData = new FoodNutritionalStorData();
    $foodNutritionalStorData->setIdFood($food->getId());
    list($foodNutritionalStor, $foodNutritionalStorInd) = FoodNutritionalStor::findByIdFood($foodNutritionalStorData, false, $dbConnection);
    foreach ($foodNutritionalStor as $foodNutritional) {
      $nutritionalNameStorData  = new NutritionalNameStorData();
      $nutritionalNameStorData->setIdNutritional($foodNutritional->getIdNutritional());
      $nutritionalNameStorData->setIdLanguage($dataLanguage->getId());
      
      $nutritionalNameStor      = NutritionalNameStor::findByNutritionalIdLanguage($nutritionalNameStorData, $dbConnection);
      $distriXFoodNutritionalData = new DistriXFoodNutritionalData();
      $distriXFoodNutritionalData->setId($foodNutritional->getId());
      $distriXFoodNutritionalData->setIdFood($food->getId());
      $distriXFoodNutritionalData->setIdNutritional($foodNutritional->getIdNutritional());
      $distriXFoodNutritionalData->setNameNutritional($nutritionalNameStor->getName());
      $distriXFoodNutritionalData->setNutritional($foodNutritional->getNutritional());
      
      foreach ($weightsName as $weightName) {
        if ($weightName->getIdWeightType() == $foodNutritional->getIdWeightType()){
          $distriXFoodNutritionalData->setIdWeightType($foodNutritional->getIdWeightType());
          $distriXFoodNutritionalData->setNameWeightType($weightName->getName());
        }
        
        if ($weightName->getIdWeightType() == $foodNutritional->getIdWeightTypeBase()){
          $distriXFoodNutritionalData->setIdWeightTypeBase($foodNutritional->getIdWeightTypeBase());
          $distriXFoodNutritionalData->setNameWeightTypeBase($weightName->getName());
        }
      }

      $distriXFoodNutritionalData->setStatus($foodNutritional->getStatus());
      $distriXFoodNutritionalData->setTimestamp($foodNutritional->getTimestamp());
      $foodNutritionals[]         = $distriXFoodNutritionalData;
    }
    $distriXFoodFoodData->setFoodNutritionals($foodNutritionals);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                                    FoodWeights                                                       //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $foodWeightStorData = new FoodWeightStorData();
    $foodWeightStorData->setIdFood($food->getId());
    list($foodWeightStor, $foodWeightStorInd) = FoodWeightStor::findByIdFood($foodWeightStorData, false, $dbConnection);
    foreach ($foodWeightStor as $foodWeight) {
      $distriXFoodWeightData = new DistriXFoodWeightData();
      $distriXFoodWeightData->setId($foodWeight->getId());
      $distriXFoodWeightData->setIdFood($food->getId());
      
      foreach ($weightsName as $weightName) {
        if ($weightName->getIdWeightType() == $foodWeight->getIdWeightType()){
          $distriXFoodWeightData->setIdWeightType($foodWeight->getIdWeightType());
          $distriXFoodWeightData->setNameWeightType($weightName->getName());
        }
      }

      $distriXFoodWeightData->setWeight($foodWeight->getWeight());
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/' . $foodWeight->getLinkToPicture();
      $pictures_headers = get_headers($urlPicture);
      if ($foodWeight->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $foodWeight->getLinkToPicture() == '') {
        $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_FOOD . '/default.png';
      }
      $distriXFoodWeightData->setLinkToPicture($urlPicture);
      $distriXFoodWeightData->setSize($foodWeight->getSize());
      $distriXFoodWeightData->setType($foodWeight->getType());
      $distriXFoodWeightData->setStatus($foodWeight->getStatus());
      $distriXFoodWeightData->setTimestamp($foodWeight->getTimestamp());
      $foodWeights[]         = $distriXFoodWeightData;
    }
    $distriXFoodFoodData->setFoodWeights($foodWeights);

    $distriXFoodFoodData->setStatus($food->getStatus());
    $distriXFoodFoodData->setTimestamp($food->getTimestamp());
    $foods[]  = $distriXFoodFoodData;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListFoods", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListFoods", $foods);

// Return response
$dataSvc->endOfService();

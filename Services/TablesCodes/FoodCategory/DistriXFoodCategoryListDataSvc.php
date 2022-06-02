<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STOR DATA
include(__DIR__ . "/../../../GlobalData/DistriXGeneralIdData.php");
include(__DIR__ . "/Data/DistriXCodeTableFoodCategoryData.php");
include(__DIR__ . "/Data/DistriXCodeTableFoodCategoryNameData.php");
// Database Data
include(__DIR__ . "/Data/CategoryNameStorData.php");
include(__DIR__ . "/Data/CategoryStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/CategoryNameStor.php");
include(__DIR__ . "/Storage/CategoryStor.php");

$databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$category     = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $dataLanguage = $dataSvc->getParameter("dataLanguage");
  
  list($categoryStor, $categoryStorInd) = CategoryStor::getList(true, $dbConnection);
  foreach ($categoryStor as $FoodCategory) {
    $categoryNameStorData = new CategoryNameStorData();
    $categoryNameStorData->setIdCategory($FoodCategory->getId());
    $categoryNameStorData->setIdLanguage($dataLanguage->getId());
    $categoryNameStor = CategoryNameStor::findByIdCategoryIdLanguage($categoryNameStorData, $dbConnection);
    
    $distriXCodeTableFoodCategoryNameData =  new DistriXCodeTableFoodCategoryNameData();
    $distriXCodeTableFoodCategoryNameData->setId($categoryNameStor->getId());
    $distriXCodeTableFoodCategoryNameData->setIdCategory($categoryNameStor->getIdCategory());
    $distriXCodeTableFoodCategoryNameData->setIdLanguage($categoryNameStor->getIdLanguage());
    $distriXCodeTableFoodCategoryNameData->setCode($FoodCategory->getCode());
    $distriXCodeTableFoodCategoryNameData->setName($categoryNameStor->getName());
    $distriXCodeTableFoodCategoryNameData->setElemState($FoodCategory->getElemState());
    $distriXCodeTableFoodCategoryNameData->setTimestamp($FoodCategory->getTimestamp());
    $category[]  = $distriXCodeTableFoodCategoryNameData;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListFoodCategory", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListFoodCategory", $category);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
if ($dataSvc->isAuthorized()) {
  // DISTRIX Init
  include("../DistriXInit/DistriXSvcDataServiceInit.php");
  // STY Const
  include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
  // Error
  include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
  // Database Data
  include(__DIR__ . "/Data/LanguageStorData.php");
  include(__DIR__ . "/Data/FoodStorData.php");
  include(__DIR__ . "/Data/FoodNameStorData.php");
  // Storage
  include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
  include(__DIR__ . "/Storage/FoodStor.php");
  include(__DIR__ . "/Storage/FoodNameStor.php");

  // Cdn Location
  include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnLocationConst.php");
  include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnFolderConst.php");

  $databasefile = __DIR__ . "/../../../Services/Db/Infodb.php";

  $dbConnection = null;
  $errorData    = null;
  $foods        = [];

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dataLanguage, $jsonError) = LanguageStorData::getJsonData($dataSvc->getParameter("dataLanguage"));
    list($foodStor, $foodStorInd)   = FoodStor::getList(true, $dbConnection);
    foreach ($foodStor as $food) {
      $foodNameStorData = new FoodNameStorData();
      $foodNameStorData->setIdFood($food->getId());
      $foodNameStorData->setIdLanguage($dataLanguage->getId());
      $foodNameStor = FoodNameStor::findByIdFoodIdLanguage($foodNameStorData, $dbConnection);
      if ($foodNameStor->getId() > 0) {
        $food->setName($foodNameStor->getName());
      }
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListFoods", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ListFoods", $foodStor);

  // Return response
  $dataSvc->endOfService();
} else {
  die();
}
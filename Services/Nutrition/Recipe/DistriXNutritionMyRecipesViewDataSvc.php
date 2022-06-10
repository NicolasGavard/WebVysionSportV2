<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Cdn Location
  include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnLocationConst.php");
  include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");
  // Storage
  include(__DIR__ . "/Storage/RecipeStor.php");
  // STOR Data
  include(__DIR__ . "/Data/RecipeStorData.php");
  
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($recipeStorData, $jsonError)   = RecipeStorData::getJsonData($dataSvc->getParameter("data"));
    $recipeStor                         = RecipeStor::read($recipeStorData->getId(), $dbConnection);
    $urlPicture   = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_RECIPE . '/' . $recipeStor->getLinkToPicture();
      $pictures_headers = get_headers($urlPicture);
      if ($recipeStor->getLinkToPicture() == '' || !$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found' || $recipeStor->getLinkToPicture() == '') {
        $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_RECIPE . '/default.png';
      }
      $recipeStor->setLinkToPicture($urlPicture);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ViewMyRecipe", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ViewMyRecipe", $recipeStor);
}
// Return response
$dataSvc->endOfService();

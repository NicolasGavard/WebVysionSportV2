<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Storage
  include(__DIR__ . "/Storage/RecipeFoodStor.php");
  // STOR Data
  include(__DIR__ . "/Data/RecipeFoodStorData.php");
  
  $dbConnection     = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($data, $jsonError)                   = RecipeFoodStorData::getJsonData($dataSvc->getParameter("data"));
    list($recipeFoodStor, $recipeFoodStorInd) = RecipeFoodStor::findByIdRecipe($data, true, $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListMyRecipesFoods", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ListMyRecipeFoods", $recipeFoodStor);
}

// Return response
$dataSvc->endOfService();

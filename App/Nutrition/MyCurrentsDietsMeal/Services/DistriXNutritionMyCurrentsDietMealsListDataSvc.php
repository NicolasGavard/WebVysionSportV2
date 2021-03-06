<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Storage
  include(__DIR__ . "/Storage/DietMealStor.php");
  // STOR Data
  include(__DIR__ . "/Data/DietMealStorData.php");
  
  $myCurrentsDiets  = [];
  $dbConnection     = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($data, $jsonError)       = DietStorData::getJsonData($dataSvc->getParameter("data"));
    list($dietStor, $dietStorInd) = DietStor::findByIdUserCoach($data, true, $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListMyCurrentsDiets", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ListMyCurrentsDiets", $dietStor);
}

// Return response
$dataSvc->endOfService();

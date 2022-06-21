<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Storage
  include(__DIR__ . "/../Storage/DietStor.php");
  // STOR Data
  include(__DIR__ . "/../Data/DietStorData.php");
  
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($dietStorData, $jsonError)   = DietStorData::getJsonData($dataSvc->getParameter("data"));
    $dietStor                         = DietStor::read($dietStorData->getId(), $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ViewMyCurrentDiet", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ViewMyCurrentDiet", $dietStor);
}
// Return response
$dataSvc->endOfService();

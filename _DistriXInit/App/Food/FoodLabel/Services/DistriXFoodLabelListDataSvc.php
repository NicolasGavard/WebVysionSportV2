<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/FoodLabelStorData.php");
// Storage
include(__DIR__ . "/Storage/FoodLabelStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($data, $jsonError)                 = FoodLabelStorData::getJsonData($dataSvc->getParameter("data"));
  list($foodLabelStor, $foodLabelStorInd) = FoodLabelStor::findByIdFood($data, true, $dbConnection);
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "ListFoodLabels", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}

$dataSvc->addToResponse("ListFoodLabels", $foodLabelStor);

// Return response
$dataSvc->endOfService();

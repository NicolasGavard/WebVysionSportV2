<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");

if ($dataSvc->isAuthorized()) {
  // Storage
  include(__DIR__ . "/../Storage/DietStor.php");
  // STOR Data
  include(__DIR__ . "/../Data/DietStorData.php");
  
  if (is_null($dbConnection->getError())) {
    $data = $dataSvc->getParameter("data");
    list($styApplicationStor, $styApplicationStorInd) = StyApplicationStor::findByIndCode($data, true, $dbConnection);
    foreach ($styApplicationStor as $application) {
      $infoApplication = DistriXSvcUtil::setData($application, "DistriXStyApplicationData");
      $applications[]  = $infoApplication;
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListApplications", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ListApplications", $applications);
}

// Return response
$dataSvc->endOfService();

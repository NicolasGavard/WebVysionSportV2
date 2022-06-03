<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/Init/DistriXTemplateDietInitDataSvc.php");

if ($dataSvc->isAuthorized()) {
  $myTemplatesDiets = [];
  $dbConnection     = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($data, $jsonError)       = DietTemplateStorData::getJsonData($dataSvc->getParameter("data"));
    list($dietTemplateStor, $dietTemplateStorInd) = DietTemplateStor::findByIdUserCoach($data, true, $dbConnection);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListMyTemplatesDiets", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ListMyTemplatesDiets", $dietTemplateStor);
}

// Return response
$dataSvc->endOfService();

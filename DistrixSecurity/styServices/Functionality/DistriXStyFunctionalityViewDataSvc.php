<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyFunctionalityData.php");
// Database Data
include(__DIR__ . "/Data/StyFunctionalityStorData.php");
include(__DIR__ . "/Data/StyModuleStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyFunctionalityStor.php");
include(__DIR__ . "/Storage/StyModuleStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data = $dataSvc->getParameter("data");
  $styFunctionalityStor = StyFunctionalityStor::read($data->getId(), $dbConnection);
  $infoFunctionality    = DistriXSvcUtil::setData($styFunctionalityStor, "DistriXStyFunctionalityData");

  $styModuleStor = StyFunctionalityStor::read($styFunctionalityStor->getIdStyModule(), $dbConnection);
  $infoFunctionality->setCodeStyModule($styModuleStor->getCode());

} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListFunctionalities", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewFunctionality", $infoFunctionality);

// Return response
$dataSvc->endOfService();

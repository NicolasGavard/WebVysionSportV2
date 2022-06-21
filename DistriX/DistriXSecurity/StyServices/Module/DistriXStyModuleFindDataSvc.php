<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyModuleData.php");
// Database Data
include(__DIR__ . "/Data/StyModuleStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyModuleStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$modules      = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data = $dataSvc->getParameter("data");
  list($styModuleStor, $styModuleStorInd) = StyModuleStor::findByIndCode($data, true, $dbConnection);
  foreach ($styModuleStor as $application) {
    $infoModule = DistriXSvcUtil::setData($application, "DistriXStyModuleData");

    $styApplicationStor = StyApplicationStor::read($application->getIdStyApplication(), $dbConnection);
    $infoModule->setCodeStyApplication($styApplicationStor->getCode());
    // $infoModule->setNameStyApplication($styApplicationStor->getName());

    $modules[]  = $infoModule;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListModules", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListModules", $modules);

// Return response
$dataSvc->endOfService();

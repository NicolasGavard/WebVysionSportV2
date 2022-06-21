<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX STY Init
include(__DIR__.'/../Init/DataSvcInit.php');
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyUserTypeData.php");
// Database Data
include(__DIR__ . "/Data/StyUserTypeStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserTypeStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection = null;
$errorData    = null;

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data = $dataSvc->getParameter("data");
  $styUserTypestor = StyUserTypeStor::read($data->getId(), $dbConnection);
  $infoUserType    = DistriXSvcUtil::setData($styUserTypestor, "DistriXStyUserTypeData");
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListUserTypes", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewUserType", $infoUserType);

// Return response
$dataSvc->endOfService();

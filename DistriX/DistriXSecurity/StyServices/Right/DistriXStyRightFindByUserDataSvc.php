<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX STY Init
include(__DIR__.'/../Init/DataSvcInit.php');
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/StyApplicationStorData.php");
include(__DIR__ . "/Data/StyUserStorData.php");
include(__DIR__ . "/Data/StyUserAllRightStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserRightStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";
$dbConnection = null;
$errorData    = null;
$allRights   = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if ($dbConnection != null) {
  list($_data, $jsonError)          = StyApplicationStorData::getJsonData($dataSvc->getParameter("data"));
  list($_infosSession, $jsonError)  = StyUserStorData::getJsonData($dataSvc->getParameter("infoSession"));

  if ($_data != null && $_infosSession != null) {
    $styUserAllRightStorData = new StyUserAllRightStorData();
    $styUserAllRightStorData->setIdStyUser($_infosSession->getId());
    $styUserAllRightStorData->setStyApplicationCode($_data->getCode());
    list($allRights, $allRightsInd) = StyUserRightStor::findAllByUserApp($styUserAllRightStorData, $dbConnection);
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse("ApplicationError", $errorData);
}
$dataSvc->addToResponse("StyUserRights", $allRights);

// Return response
$dataSvc->endOfService();

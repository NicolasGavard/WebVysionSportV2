<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX STY Init
include(__DIR__.'/../Init/DataSvcInit.php');
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/StyEnterpriseStorData.php");
include(__DIR__ . "/Data/StyEnterprisePosStorData.php");
include(__DIR__ . "/Data/StyUserStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyEnterpriseStor.php");
include(__DIR__ . "/Storage/StyEnterprisePosStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";
$dbConnection = null;
$errorData    = null;

$userEnterprises  = [];
$enterprises      = [];
$enterprisepos    = [];
$styEnterprisePosStor = [];

$dbConnection     = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if ($dbConnection != null) {
  list($_infosSession, $jsonError)  = StyUserStorData::getJsonData($dataSvc->getParameter("infoSession"));
  if ($_infosSession != null) {
    
    // $enterprises
    $styEnterpriseStorData = new StyEnterpriseStorData();
    $styEnterpriseStorData->setId($_infosSession->getIdStyEnterprise());
    $styEnterpriseStor     = StyEnterpriseStor::read($styEnterpriseStorData->getId(), $dbConnection);
    if ($styEnterpriseStor->getIdStyEnterpriseParent() > 0) {
      list($styEnterpriseStor, $styEnterpriseStorInd) = StyEnterpriseStor::findByIdParent($enterprise, false, $dbConnection);
      foreach ($styEnterpriseStor as $enterprise) {
        $styEnterprisePosStorData = new StyEnterprisePosStorData();
        $styEnterprisePosStorData->setStyIdEnterprise($enterprise->getIdStyEnterpriseParent());
        $styEnterprisePos         = StyEnterprisePosStor::findByEnterprisePos($styEnterprisePosStorData, $dbConnection);
        $styEnterprisePosStor[]   = $styEnterprisePos;
      }
    } else {
      $styEnterprisePosStorData   = new StyEnterprisePosStorData();
      $styEnterprisePosStorData->setStyIdEnterprise($styEnterpriseStor->getId());
      $styEnterprisePosStor       = StyEnterprisePosStor::findByEnterprisePos($styEnterprisePosStorData, $dbConnection);
    }
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse("ApplicationError", $errorData);
}

$dataSvc->addToResponse("StyUserEnterprises", $userEnterprises);
$dataSvc->addToResponse("StyEnterprises", $styEnterpriseStor);
$dataSvc->addToResponse("StyEnterprisePos", $styEnterprisePosStor);

// Return response
$dataSvc->endOfService();

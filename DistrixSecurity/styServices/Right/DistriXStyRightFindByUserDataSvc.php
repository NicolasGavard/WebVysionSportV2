<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyUserData.php");
include(__DIR__ . "/../../Data/DistriXStyLoginData.php");
include(__DIR__ . "/../../Data/DistriXStyUserRightData.php");
// Database Data
include(__DIR__ . "/Data/StyUserAllRightStorData.php");
include(__DIR__ . "/Data/StyUserRightStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserRightStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";
$dbConnection = null;
$errorData    = null;
$userRights   = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if ($dbConnection != null) {
  $_data         = $dataSvc->getParameter("data");
  $_infosSession = $dataSvc->getParameter("infoSession");

  list($data, $jsonError) = StyUserStorData::getJsonData($dataSvc->getParameter("data"));
  list($_infosSession, $jsonError) = StyUserStorData::getJsonData($dataSvc->getParameter("data"));
  
  if ($_data != null && $_infosSession != null) {
    $styUserAllRightStorData = new StyUserAllRightStorData();
    $styUserAllRightStorData->setIdStyUser($_infosSession->getId());
    $styUserAllRightStorData->setStyApplicationCode($_data->getApplication());
    list($allRights, $allRightsInd) = StyUserRightStor::findAllByUserApp($styUserAllRightStorData, $dbConnection);
    foreach ($allRights as $right) {
      $data = new DistriXStyUserRightData();
      $data->setCodeApplication($right->getStyApplicationCode());
      $data->setCodeModule($right->getStyModuleCode());
      $data->setCodeFunctionality($right->getStyFunctionalityCode());
      $data->setSumOfRights($right->getSumOfRights());
      $userRights[] = $data;
    }
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addToResponse("ApplicationError", $errorData);
}
$dataSvc->addToResponse("StyUserRights", $userRights);

// Return response
$dataSvc->endOfService();

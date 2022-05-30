<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../../Data/DistriXStyLoginData.php");
include(__DIR__ . "/../../Data/DistriXStyUserRightsData.php");
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
  list($_data, $jsonError) = DistriXStyLoginData::getJsonData($dataSvc->getParameter("data"));
  list($_infosSession, $jsonError) =  DistriXStyInfoSessionData::getJsonData($dataSvc->getParameter("infoSession"));
  if ($_data != null && $_infosSession != null) {
    $styUserAllRightStorData = new StyUserAllRightStorData();
    $styUserAllRightStorData->setStyApplicationCode($_data->getApplication());
    $styUserAllRightStorData->setIdStyUser($_infosSession->getIdUser());
    list($allRights, $allRightsInd) = StyUserRightStor::findAllByUserApp($styUserAllRightStorData, $dbConnection);
    foreach ($allRights as $right) {
      $data = new DistriXStyUserRightsData();
      $data->setApplicationCode($right->getStyApplicationCode());
      $data->setModuleCode($right->getStyModuleCode());
      $data->setFunctionalityCode($right->getStyFunctionalityCode());
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

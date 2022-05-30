<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../../Data/DistriXStyEnterpriseData.php");
include(__DIR__ . "/../../Data/DistriXStyEnterprisePosData.php");
include(__DIR__ . "/../../Data/DistriXStyUserEnterpriseData.php");
// Database Data
include(__DIR__ . "/Data/EnterpriseStorData.php");
include(__DIR__ . "/Data/EnterprisePosStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/EnterpriseStor.php");
include(__DIR__ . "/Storage/EnterprisePosStor.php");


$databasefile    = __DIR__ . "/../Db/Infodb.php";
$dbConnection    = null;
$errorData       = null;
$enterprises     = [];
$enterprisesData = [];
$enterprisesPos  = [];
$userEnterprises = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if ($dbConnection != null) {
  $_infosSession = $dataSvc->getParameter("infoSession");
  if ($_infosSession != null) {
    list($enterprisesStorData, $enterprisesStorDataInd) = EnterpriseStor::getParentList(false, $dbConnection);
    // Get Root enterprise
    foreach ($enterprisesStorData as $enterpriseStorData) {
      if ($enterpriseStorData->getId() == $_infosSession->getIdEnterprise()) {
        list($enterprisesPosStorData, $enterprisesPosStorDataInd) = EnterprisePosStor::getList(true, $dbConnection);
        foreach ($enterprisesPosStorData as $enterprisePosStorData) {
          if ($enterprisePosStorData->getIdEnterprise() == $enterpriseStorData->getId()) {
            $data = new DistriXStyEnterprisePosData();
            $data->setIdPos($enterprisePosStorData->getIdPos());
            $enterprisesPos[] = $data;
          }
        }
        $data = DistriXSvcUtil::setData($enterpriseStorData, "DistriXStyEnterpriseData");
        $enterprisesData[] = $data;

        $data = new DistriXStyUserEnterpriseData();
        $data->setId($enterpriseStorData->getId());
        $data->setName($enterpriseStorData->getName());
        $data->setCity($enterpriseStorData->getCity());
        $data->setIdEnterprise($enterpriseStorData->getIdEnterpriseParent());
        $userEnterprises[] = $data;
      }
    }
    foreach ($enterprisesStorData as $enterpriseStorData) {
      $found = false;
      foreach ($userEnterprises as $userEnterprise) {
        $found = ($userEnterprise->getId() == $enterpriseStorData->getIdEnterpriseParent());
        if ($found) {
          list($enterprisesPosStorData, $enterprisesPosStorDataInd) = EnterprisePosStor::getList(true, $dbConnection);
          foreach ($enterprisesPosStorData as $enterprisePosStorData) {
            if ($enterprisePosStorData->getIdEnterprise() == $enterpriseStorData->getId()) {
              $data = new DistriXStyEnterprisePosData();
              $data->setIdPos($enterprisePosStorData->getIdPos());
              $enterprisesPos[] = $data;
            }
          }
          $data = DistriXSvcUtil::setData($enterpriseStorData, "DistriXStyEnterpriseData");
          $enterprisesData[] = $data;

          $data = new DistriXStyUserEnterpriseData();
          $data->setId($enterpriseStorData->getId());
          $data->setName($enterpriseStorData->getName());
          $data->setCity($enterpriseStorData->getCity());
          $data->setIdEnterprise($enterpriseStorData->getIdEnterpriseParent());
          $userEnterprises[] = $data;
          break;
        }
      }
    }
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addToResponse("ApplicationError", $errorData);
}
$dataSvc->addToResponse("StyUserEnterprises", $userEnterprises);
$dataSvc->addToResponse("StyEnterprises", $enterprisesData);
$dataSvc->addToResponse("StyEnterprisePos", $enterprisesPos);

// Return response
$dataSvc->endOfService();

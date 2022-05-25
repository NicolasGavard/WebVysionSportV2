<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../../Data/DistriXStyLoginData.php");
// Database Data
include(__DIR__ . "/Data/StyUserStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserStor.php");
// Cdn Location
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnLocationConst.php");
include(__DIR__ . "/../../../DistriXCdn/const/DistriXCdnFolderConst.php");
// Database
$databasefile = __DIR__ . "/../Db/Infodb.php";

// Profil
if ($dataSvc->getMethodName() == "Profil") {
  $dbConnection = null;
  $errorData    = null;
  $infoSession  = new DistriXStyInfoSessionData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if ($dbConnection != null) {
    $data = $dataSvc->getParameter("data");
    $storData     = StyUserStor::read($data->getId(), $dbConnection);
    $infoSession  = DistriXSvcUtil::setData($storData, "DistriXStyInfoSessionData");

    $urlPicture       = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USER . '/' . $storData->getLinkToPicture();
    $pictures_headers = @get_headers($urlPicture);
    if (!$pictures_headers || $pictures_headers[0] == 'HTTP/1.1 404 Not Found') {
      $urlPicture = DISTRIX_CDN_URL_IMAGES . DISTRIX_CDN_FOLDER_USER . '/profilDefault.png';
    }
    $infoSession->setLinkToPicture($urlPicture);
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addToResponse("ApplicationError", $errorData);
  }
  $dataSvc->addToResponse("StyInfoSession", $infoSession);
}

/*
  $dbConnection               = null;
  $errortxt                   = "";
  $error                      = false;
  $styUserPazziRole           = array();
  $styUserPazziRoleInd  = 0;
  $styUserPazziRightStorData  = array();
  $styUserPazziRightStorDataInd  = 0;

  $infoSession      = new DjangoStyInfoSessionData();
  $userRights       = array();
  $userRightsInd       = 0;
  $userRoles        = array();
  $userRolesInd        = 0;
  $userEnterprises  = array();
  $userEnterprisesInd  = 0;
  $enterprisesPos   = array();
  $enterprisesPosInd   = 0;
  $enterprisesData  = array();
  $enterprisesDataInd  = 0;

  $connect = new StorPDOConnection($databasefile);
  list($dbConnection, $error, $errortxt) = $connect->openConnection();
  if ($dbConnection != null) {
    $data = $dataSvc->getParameter("data");
    $styUserPazziStor = new StyUserPazziStor();
    $styUserPazziStorData = new StyUserPazziStorData();
    $styUserPazziStorData->setLogin($data->getLogin());
    $styUserPazziStorData->setPass($data->getPassword());
    $styUserPazziStorData = $styUserPazziStor->login($styUserPazziStorData, $dbConnection);
    if ($styUserPazziStorData->getId() > 0) {
      $strErr = "Login " . $styUserPazziStorData->getFirstName() . ' ' . $styUserPazziStorData->getName();
      log_error(STY_SERVICES, $layerData->getIdPos(), $styUserPazziStorData->getId(), "IT", $data->getApplication() . " : Login", $strErr, false, '');

      $infoSession->setIdUser($styUserPazziStorData->getId());
      $infoSession->setConnected(true);
      $infoSession->setIdLanguage($styUserPazziStorData->getIdLanguage());
      $infoSession->setFirstName($styUserPazziStorData->getFirstName());
      $infoSession->setName($styUserPazziStorData->getName());
      $infoSession->setLinkToPicture($styUserPazziStorData->getLinkToPicture());
      $infoSession->setSize($styUserPazziStorData->getSize());
      $infoSession->setType($styUserPazziStorData->getType());
      $infoSession->setPass($styUserPazziStorData->getPass());
      $infoSession->setEmail($styUserPazziStorData->getEmail());
      $infoSession->setPhone($styUserPazziStorData->getPhone());
      $infoSession->setMobile($styUserPazziStorData->getMobile());
      $infoSession->setInitPass($styUserPazziStorData->getInitPass());
      $infoSession->setIdLanguage($styUserPazziStorData->getIdLanguage());
      $infoSession->setIdEnterprise($styUserPazziStorData->getIdEnterprise());
      $infoSession->setStatus($styUserPazziStorData->getStatus());


      $enterprises = array();
      $enterprisesInd = 0;
      list($enterprises, $enterprisesInd) = (new EnterpriseStor())->getParentList(false, $dbConnection);
      // Get Root enterprise
      for ($indE = 0; $indE < $enterprisesInd; $indE++) {
        if ($enterprises[$indE]->getId() == $infoSession->getIdEnterprise()) {

          $enterprisePosStor = new EnterprisePosStor();
          // list($enterprisePosData, $enterprisePosDataInd) = $enterprisePosStor->getListByIdEnterprise($enterprises[$indE]->getId(), $dbConnection);
          list($enterprisePosData, $enterprisePosDataInd) = $enterprisePosStor->getList(true, $dbConnection);
          for ($indEp = 0; $indEp < $enterprisePosDataInd; $indEp++) {
            if ($enterprisePosData[$indEp]->getIdEnterprise() == $enterprises[$indE]->getId()) {
              $data = new DjangoStyEnterprisePosData();
              $data->setIdPos($enterprisePosData[$indEp]->getIdPos());
              $enterprisesPos[$enterprisesPosInd++] = $data;
            }
          }
          $data = new DjangoStyEnterpriseData();
          $data->setIdCountry($enterprises[$indE]->getIdCountry());
          $enterprisesData[$enterprisesDataInd++] = $data;

          $data = new DjangoStyUserEnterpriseData();
          $data->setId($enterprises[$indE]->getId());
          $data->setName($enterprises[$indE]->getName());
          $data->setCity($enterprises[$indE]->getCity());
          $data->setIdEnterprise($enterprises[$indE]->getIdEnterpriseParent());
          $userEnterprises[$userEnterprisesInd++] = $data;
        }
      }

      for ($indE = 0; $indE < $enterprisesInd; $indE++) {
        $found = false;
        for ($indUserE = 0; $indUserE < $userEnterprisesInd && !$found; $indUserE++) {
          $found = $userEnterprises[$indUserE]->getId() == $enterprises[$indE]->getIdEnterpriseParent();
        }
        if ($found) {
          // list($enterprisePosData, $enterprisePosDataInd) = (new EnterprisePosStor())->getListByIdEnterprise($enterprises[$indE]->getIdEnterpriseParent(), $dbConnection);
          // for ($indEp=0; $indEp < $enterprisePosDataInd; $indEp++) { 
          //   $data = new DjangoStyEnterprisePosData();
          //   $data->setIdPos($enterprisePosData[$indEp]->getIdPos());
          //   $enterprisesPos[$enterprisesPosInd] = $data;
          // }
          list($enterprisePosData, $enterprisePosDataInd) = $enterprisePosStor->getList(true, $dbConnection);
          for ($indEp = 0; $indEp < $enterprisePosDataInd; $indEp++) {
            if ($enterprisePosData[$indEp]->getIdEnterprise() == $enterprises[$indE]->getId()) {
              $data = new DjangoStyEnterprisePosData();
              $data->setIdPos($enterprisePosData[$indEp]->getIdPos());
              $enterprisesPos[$enterprisesPosInd++] = $data;
            }
          }
          $data = new DjangoStyEnterpriseData();
          $data->setIdCountry($enterprises[$indE]->getIdCountry());
          $enterprisesData[$enterprisesDataInd++] = $data;

          $data = new DjangoStyUserEnterpriseData();
          $data->setId($enterprises[$indE]->getId());
          $data->setName($enterprises[$indE]->getName());
          $data->setCity($enterprises[$indE]->getCity());
          $data->setIdEnterprise($enterprises[$indE]->getIdEnterpriseParent());
          $userEnterprises[$userEnterprisesInd++] = $data;
        }
      }
      $connect->closeConnection();
    }
  }
  $dataSvc->addToResponse("StyInfoSession", $infoSession);
  $dataSvc->addToResponse("StyUserRoles", $userRoles);
  $dataSvc->addToResponse("StyUserRights", $userRights);
  $dataSvc->addToResponse("StyUserEnterprises", $userEnterprises);
  $dataSvc->addToResponse("StyEnterprises", $enterprisesData);
  $dataSvc->addToResponse("StyEnterprisePos", $enterprisesPos);
}
*/
// Return response
$dataSvc->endOfService();

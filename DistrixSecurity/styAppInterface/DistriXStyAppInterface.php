<?php // Needed to encode in UTF8 ààéàé //
// Constants
include(__DIR__ . "/../const/DistriXStyAuthenticationConst.php");
include(__DIR__ . "/../const/DistriXStyRightConst.php");
// Data
include(__DIR__ . "/../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../Data/DistriXStyEnterpriseData.php");
include(__DIR__ . "/../Data/DistriXStyEnterprisePosData.php");
include(__DIR__ . "/../Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../Data/DistriXStyLoginData.php");
include(__DIR__ . "/../Data/DistriXStyUserData.php");
include(__DIR__ . "/../Data/DistriXStyUserEnterpriseData.php");
include(__DIR__ . "/../Data/DistriXStyUserRightData.php");
include(__DIR__ . "/../Data/DistriXStyUserRightsData.php");
include(__DIR__ . "/../Data/DistriXStyUserRoleData.php");
// Layer
include(__DIR__ . "/../layers/DistriXStySvcCaller.php");
// Distrix Crypto
include(__DIR__ . "/../../DistrixCrypto/DistriXCrypto.php");
// Distrix Logger
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

class DistriXStyAppInterface
{
  static public $styInfoSession;

  public static function loginPassword(string $application, string $user, string $password): bool
  {
    $logged = false;
    if (strlen($application) > 0 && strlen($user) > 0 && strlen($password) > 0) {
      $dataApp = new DistriXStyApplicationData();
      $dataApp->setCode($application);
      
      $dataUser = new DistriXStyUserData();
      $dataUser->setLogin($user);
      $pwd = DistriXCrypto::encodeOneWay(trim($password));
      $dataUser->setPass(trim($pwd));

      $dataLogin = new DistriXStyLoginData();
      $dataLogin->setAuthType(DISTRIX_STY_AUTH_PASSWORD);
      
      list($dataApp, $errorJson)    = DistriXStyApplicationData::getJsonData($dataApp);
      list($dataUser, $errorJson)   = DistriXStyUserData::getJsonData($dataUser);
      list($dataLogin, $errorJson)  = DistriXStyLoginData::getJsonData($dataLogin);
      $logged = self::login($dataApp, $dataUser, $dataLogin);
    }
    return $logged;
  }
  // End of loginPassword

  private static function login(DistriXStyApplicationData $dataApp, DistriXStyUserData $dataUser, DistriXStyLoginData $dataLogin): bool
  {
    if (strlen($dataLogin->getAuthType()) > 0) {     
      $outputok          = false;
      $output            = array();
      $styServicesCaller = new DistriXStySvcCaller();
      $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyLoginDataSvc.php");
      $styServicesCaller->setMethodName("Login");
      $styServicesCaller->addParameter("dataApp", $dataApp);                  //print_r($dataApp);
      $styServicesCaller->addParameter("dataUser", $dataUser);                //print_r($dataUser);
      list($outputok, $output, $errorData) = $styServicesCaller->call();      //print_r($output);
      list($infoUser, $errorJson) = DistriXStyUserData::getJsonData($output["StyInfoSession"]);

      $styGlobalSession = new DistriXStyInfoSessionData();
      $styGlobalSession->setApplication($dataApp->getCode());
      $styGlobalSession->setConnected(false);
      $styGlobalSession->setTimeConnected(date('His'));

      if ($infoUser->getId() > 0) {
        $styGlobalSession->setApplication($dataApp->getCode());
        $styGlobalSession->setConnected(true);
        $styGlobalSession->setTimeConnected(date('His'));

        $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Right/DistriXStyRightFindByUserDataSvc.php");
        $styServicesCaller->addParameter("data", $dataApp);
        $styServicesCaller->addParameter("infoSession", $infoUser);
        
        $styRolesCaller = new DistriXStySvcCaller();
        $styRolesCaller->setServiceName("DistriXSecurity/StyServices/Role/DistriXStyRoleFindByUserDataSvc.php");
        $styRolesCaller->addParameter("data", $dataApp);
        $styRolesCaller->addParameter("infoSession", $infoUser);
        
        $styEnterprisesCaller = new DistriXStySvcCaller();
        $styEnterprisesCaller->setServiceName("DistriXSecurity/StyServices/Enterprise/DistriXStyEnterpriseFindByUserDataSvc.php");
        $styEnterprisesCaller->addParameter("infoSession", $infoUser);
        
        $svc = new DistriXSvc();
        $svc->addToCall("Rights", $styServicesCaller);
        $svc->addToCall("Roles", $styRolesCaller);
        $svc->addToCall("Enterprises", $styEnterprisesCaller);
        $callsOk = $svc->call();

        list($outputok, $output, $errorData) = $svc->getResult("Roles");
        // echo " Security Roles Svc-$outputok--------<br><br>";
        // echo " Security Roles Svc-" . print_r($output, true) . "<br><br>";
        // echo " Security Roles Svc Error -" . print_r($errorData, true) . "<br><br>";
        if ($outputok && is_array($output) && isset($output["StyUserRoles"])) {
          list($userRoles, $errorJson)  = DistriXStyUserRoleData::getJsonData($output["StyUserRoles"]);
          $infoUser->setRoles($userRoles);
        }

        list($outputok, $output, $errorData) = $svc->getResult("Rights");
        // echo " Security Rights Svc-$outputok--------<br><br>";
        // echo " Security Rights Svc-" . print_r($output, true) . "<br><br>";
        // echo " Security Rights Svc Error -" . print_r($errorData, true) . "<br><br>";
        if ($outputok && is_array($output) && isset($output["StyUserRights"])) {
          list($userRights, $errorJson)       = DistriXStyUserRightData::getJsonData($output["StyUserRights"]);
        }

        list($outputok, $output, $errorData) = $svc->getResult("Enterprises");
        // echo " Security Enterprises Svc-$outputok--------<br><br>";
        // echo " Security Enterprises Svc-" . print_r($output, true) . "<br><br>";
        // echo " Security Enterprises Svc Error -" . print_r($errorData, true) . "<br><br>";
        if ($outputok && is_array($output)) {
          if (isset($output["StyUserEnterprises"])) {
            list($userEnterprises, $errorJson)  = DistriXStyUserEnterpriseData::getJsonData($output["StyUserEnterprises"]);
          }
          if (isset($output["StyEnterprises"])) {
            list($enterprisesData, $errorJson)  = DistriXStyEnterpriseData::getJsonData($output["StyEnterprises"]);
          }
          if (isset($output["StyEnterprisePos"])) {
            list($enterprisesPos, $errorJson)   = DistriXStyEnterprisePosData::getJsonData($output["StyEnterprisePos"]);
          }
        }
      }
      $_SESSION["DistriXSvcSecurity"]["StyGlobal"]          = serialize($styGlobalSession);
      $_SESSION["DistriXSvcSecurity"]["StyUser"]            = serialize($infoUser);
      $_SESSION["DistriXSvcSecurity"]["StyUserRoles"]       = serialize($userRoles);
      $_SESSION["DistriXSvcSecurity"]["StyUserRights"]      = serialize($userRights);
      $_SESSION["DistriXSvcSecurity"]["StyUserEnterprises"] = serialize($userEnterprises);
      $_SESSION["DistriXSvcSecurity"]["StyEnterprises"]     = serialize($enterprisesData);
      $_SESSION["DistriXSvcSecurity"]["StyEnterprisePos"]   = serialize($enterprisesPos);
    }
    return self::isUserConnected();
  }
  // End of login

  public static function refreshSession(string $application, int $idUser): bool
  {
    $refreshSession = false;
    if (strlen($application) > 0 && $idUser > 0) {
      $data = new DistriXStyUserData();
      $data->setId($idUser);
      $refreshSession = self::refreshSess($data);
    }
    return $refreshSession;
  }
  // End of refreshSession

  private static function refreshSess(DistriXStyUserData $data): bool
  {
    $outputok          = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("RefreshSession");
    $styServicesCaller->setServiceName("DistriXSecurity/styServices/RefreshSession/DistrixStyRefreshSessionBusSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyLoginBusSvc");
      $logInfoData->setLogFunction("refreshSess");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0 && isset($output["StyInfoUser"])) {
      $_SESSION["DistriXSvcSecurity"]["StyGlobal"]          = serialize($output["StyGlobalSession"]);
      $_SESSION["DistriXSvcSecurity"]["StyUser"]            = serialize($output["StyInfoUser"]);
      $_SESSION["DistriXSvcSecurity"]["StyUserRoles"]       = serialize($output["StyUserRoles"]);
      $_SESSION["DistriXSvcSecurity"]["StyUserRights"]      = serialize($output["StyUserRights"]);
      $_SESSION["DistriXSvcSecurity"]["StyUserEnterprises"] = serialize($output["StyUserEnterprises"]);
      $_SESSION["DistriXSvcSecurity"]["StyEnterprises"]     = serialize($output["StyEnterprises"]);
      $_SESSION["DistriXSvcSecurity"]["StyEnterprisePos"]   = serialize($output["StyEnterprisePos"]);
    }
    return self::isUserConnected();
  }
  // End of refreshSess

  public static function isUserConnected(): bool
  {
    $connected = false;
    if (isset($_SESSION["DistriXSvcSecurity"]["StyGlobal"])) {
      $userData  = unserialize($_SESSION["DistriXSvcSecurity"]["StyGlobal"]);
      $connected = ($userData->getConnected());
    }
    return $connected;
  }
  // End of isUserConnected

  public static function getUserInformation(): DistriXStyUserData
  {
    $userData = new DistriXStyUserData();
    if (isset($_SESSION["DistriXSvcSecurity"]["StyUser"])) {
      $userData = unserialize($_SESSION["DistriXSvcSecurity"]["StyUser"]);
    }
    return $userData;
  }
  // End of getUserInformation

  public static function getIdPos()
  {
    $idPos = 0;
    if (isset($_SESSION["DistriXSvcSecurity"]["StyEnterprisePos"])) {
      $userData  = unserialize($_SESSION["DistriXSvcSecurity"]["StyEnterprisePos"]);
      for ($indEp = 0; $indEp < count($userData); $indEp++) {
        if ($indEp == 0) {
          $idPos = $userData[$indEp]->getIdPos();
        }
      }
    }
    return $idPos;
  }
  // End of getIdPos

  public static function logout()
  {
    if (isset($_SESSION["DistriXSvcSecurity"]["StyGlobal"])) {
      unset($_SESSION["DistriXSvcSecurity"]['StyGlobal']);
    }
    if (isset($_SESSION["DistriXSvcSecurity"]["StyUser"])) {
      unset($_SESSION["DistriXSvcSecurity"]['StyUser']);
    }
    if (isset($_SESSION["DistriXSvcSecurity"]["StyUserRoles"])) {
      unset($_SESSION["DistriXSvcSecurity"]['StyUserRoles']);
    }
    if (isset($_SESSION["DistriXSvcSecurity"]["StyUserRights"])) {
      unset($_SESSION["DistriXSvcSecurity"]['StyUserRights']);
    }
    if (isset($_SESSION["DistriXSvcSecurity"]["StyListUsers"])) {
      unset($_SESSION["DistriXSvcSecurity"]["StyListUsers"]);
    }
    if (isset($_SESSION["DistriXSvcSecurity"]["StyListEnterprises"])) {
      unset($_SESSION["DistriXSvcSecurity"]["StyListEnterprises"]);
    }
    if (isset($_SESSION["DistriXSvcSecurity"]["StyListUsersTypes"])) {
      unset($_SESSION["DistriXSvcSecurity"]["StyListUsersTypes"]);
    }
    if (isset($_SESSION["DistriXSvcSecurity"]["StyListRoles"])) {
      unset($_SESSION["DistriXSvcSecurity"]["StyListRoles"]);
    }
    if (isset($_SESSION["DistriXSvcSecurity"]["StyListApplications"])) {
      unset($_SESSION["DistriXSvcSecurity"]["StyListApplications"]);
    }
  }
  // End of logout

  public static function isSecurityOk(string $application, string $module, string $functionality = '', int $right=0): bool
  {
    $isSecurityOk = false; 
    $globalData   = unserialize($_SESSION["DistriXSvcSecurity"]["StyGlobal"]);
    if (isset($globalData)) {
      if ($globalData->getApplication() == $application) {
        if ($globalData->getTimeConnected() == time() - $globalData->getTimeConnected() > 1800) { // 1800 Seconds or 30 Minuts
          self::refreshSession($application, $globalData->getIdUser());
        }
        $isSecurityOk = self::isUserConnected() && self::hasRight($application, $module, $functionality, $right);
      }
    }
    // Will need a rework for better security. Including function security level or finer rights for example. Yvan 13-9-19
    // return (self::isUserConnected() && self::hasAnyRight($application, $module, $functionality));
    return $isSecurityOk;
  }
  // End of isSecurityOk

  public static function hasRight(string $app, string $module, string $functionality, int $right): string
  {
    $hasRight = false;
    if ($right > 0 && $app != "" && isset($_SESSION["DistriXSvcSecurity"]["StyUserRights"])) {
      $userRights = unserialize($_SESSION["DistriXSvcSecurity"]["StyUserRights"]);
      $userRightsInd = 0;
      if (!empty($userRights)) {
        $userRightsInd = count($userRights);
      }
      for ($indR = 0; $indR < $userRightsInd && !$hasRight; $indR++) {
        $dataRight = $userRights[$indR];
        if (
          $dataRight->getCodeApplication() == $app &&
          ($dataRight->getCodeModule() == $module || $module == "") &&
          ($dataRight->getCodeFunctionality() == $functionality || $functionality == "")
        ) {
          $calc = $dataRight->getSumOfRights();
          // echo "#hasRight#@calc#$calc<br/>";
          // echo "#hasRight#@right recherche#$right<br/>";

          $hasRight = ($calc >= $right || $calc == DISTRIX_STY_RIGHT_MAX);
          // les droits sont-ils assez élevés pour le droit recheché  or Full Power User ?
          if ($hasRight && $calc != DISTRIX_STY_RIGHT_MAX) {
            $calc -= $right;
            // echo "hasRight#@calc - right #$calc<br/>";
            if ($calc == 0) {
              $hasRight = true; // Seulement un droit et celui recherché
            } else {
              $i = DISTRIX_STY_RIGHT_MAX;
              while ($i >= DISTRIX_STY_RIGHT_NONE) {
                if ($calc >= $i && $i != $right) { // Droit mixé avec d'autres droits ?
                  $calc -= $i;
                  // echo "hasRight#@type role#$i<br/>";
                  // echo "hasRight#@calc #$calc<br/>";
                }
                $i = $i / 2;
              }
            }
            $hasRight = ($calc == 0);
            $hasRight = ($calc == 0)?1:0;
          }
        }
      }
    }
    return $hasRight;
  }
  // End of hasRight

  public static function hasAnyRight(string $app, string $module, string $functionality): bool
  {
    $hasRight = false;
    if ($app != "" && isset($_SESSION["DistriXSvcSecurity"]["StyUserRights"])) {
      $userRights = unserialize($_SESSION["DistriXSvcSecurity"]["StyUserRights"]);
      $userRightsInd = 0;
      if (!empty($userRights)) {
        $userRightsInd = count($userRights);
      }
      for ($indR = 0; $indR < $userRightsInd && !$hasRight; $indR++) {
        $dataRight = $userRights[$indR];
        if (
          $dataRight->getCodeApplication() == $app &&
          ($dataRight->getCodeModule() == $module || $module == "") &&
          ($dataRight->getCodeFunctionality() == $functionality || $functionality == "")
        ) {
          $hasRight = true;
        }
      }
    }
    return $hasRight;
  }
  // End of hasAnyRight

  public static function getRightView():int       { return DISTRIX_STY_RIGHT_VIEW; }
  public static function getRightChange():int     { return DISTRIX_STY_RIGHT_CHANGE; }
  public static function getRightAdd():int        { return DISTRIX_STY_RIGHT_ADD; }
  public static function getRightRemove():int     { return DISTRIX_STY_RIGHT_REMOVE; }
  public static function getRightDelete():int     { return DISTRIX_STY_RIGHT_DELETE; }
  public static function getRightPrint():int      { return DISTRIX_STY_RIGHT_PRINT; }
  public static function getRightList():int       { return DISTRIX_STY_RIGHT_LIST; }
  public static function getRightFollow():int     { return DISTRIX_STY_RIGHT_FOLLOW; }
  public static function getRightSecurity():int   { return DISTRIX_STY_RIGHT_SECURITY; }
  public static function getRightPublish():int    { return DISTRIX_STY_RIGHT_PUBLISH; }
  public static function getRightRestore():int    { return DISTRIX_STY_RIGHT_RESTORE; }
  public static function getRightDuplicate():int  { return DISTRIX_STY_RIGHT_DUPLICATE; }
  public static function getRightAgenda():int     { return DISTRIX_STY_RIGHT_AGENDA; }
  public static function getRightUse():int        { return DISTRIX_STY_RIGHT_USE; }
  public static function getRightManage():int     { return DISTRIX_STY_RIGHT_MANAGE; }
}

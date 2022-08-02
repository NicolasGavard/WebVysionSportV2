<?php // Needed to encode in UTF8 ààéàé //
// DjangoSvc
include(DJANGOSTY_APP_DJANGOSVC_ACCESS_PATH . "DjangoAppInclude.php");
// Constants
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/Const/_DjangoStyAuthenticationConst.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/Const/_DjangoStyRightConst.php");
// Utilities
include(DJANGOSVC_TWO_LEVEL_UP . "_env.php"); // Always after _util.php (contains goToTopDirectory() function). Nico &  03-09-21
// Data Error
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/error/AppErrorSvcData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/error/AppErrorSvcErrorData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/error/AppErrorSvcErrorPayloadData.php");
// Data
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyApplicationData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyEnterpriseData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyInfoUserPazziData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyForgetPassData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyInitPassData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyLoginData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyRolesData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyRolesRightsCompletData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyRolesRightsData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyUserData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyUserPictureData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyInfoSessionData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyUserRolesData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyUserRightsData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyUserEnterpriseData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyUserTypesData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyEnterpriseData.php");
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/data/DjangoStyEnterprisePosData.php");
// Cryptage
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/styCrypto/DjangoStyCrypto.php");
// Layer
include(DJANGOSTY_STY_ACCESS_PATH . "DjangoSty/StyAppInterface/layer/DjangoSvcCallerSty.php");
include(DJANGOSTY_APP_DJANGOSVC_ACCESS_PATH . "layer/DjangoSvcLayerData.php");

class DjangoStyForApp
{
  static private $styUser       = array();
  static private $styUserRights = array();
  static private $stySession    = 0;
  static public $styInfoSession;

  public static function listRolesRights($idUser = '', $layerData)
  {
    $listUsers = array();
    $listUsersInd = 0;
    $djangoStyUserRolesData = new DjangoStyUserRolesData();
    $djangoStyUserRolesData->setIdUser($idUser);
    $listUsers = self::listAllRolesRights($djangoStyUserRolesData, $layerData);
    return $listUsers;
  }
  // End of listRolesRights 

  private static function listAllRolesRights($data, $layerData)
  {
    $output               = array();
    $outputok             = false;
    $listUserRolesRights  = new DjangoStyRolesRightsCompletData();
    $clientSvcCall        = new DjangoSvcCallerSty();
    $clientSvcCall->addParameter("data", $data);
    $clientSvcCall->setMethodName("ListRolesRights");
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/RolesRights/StyRolesRightsDataSvc.php");
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call(); //echo " STY List Users Enterprise : ".print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["listRolesRights"])) {
        $listUserRolesRights = $output["listRolesRights"];
        $_SESSION["DjangoSvcSecurity"]["StyListRolesRights"] = serialize($listUserRolesRights);
      }
    }
    return array($listUserRolesRights);
  }
  // End of listUsersEnterprise


  public static function listUsers($idStyEnterprise = "", $layerData)
  {
    $listUsers = array();
    $listUsersInd = 0;
    if (strlen($idStyEnterprise) > 0) {
      $data = new DjangoStyInfoSessionData();
      $data->setIdStyEnterprise($idStyEnterprise);
      $listUsers = self::listUsersEnterprise($data, $layerData);
    }
    return $listUsers;
  }
  // End of listUsers 

  private static function listUsersEnterprise($data, $layerData)
  {
    $output           = array();
    $outputok         = false;
    $listUsers        = new DjangoStyUserData();
    $listUsersTypes   = new DjangoStyUserTypesData();
    $listEnterprises  = new DjangoStyEnterpriseData();
    $listRoles        = new DjangoStyRolesData();
    $listLanguages    = new DjangoStyUserData();
    $clientSvcCall    = new DjangoSvcCallerSty();
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Users/StyUsersDataSvc.php");
    $clientSvcCall->setMethodName("ListUsers");
    $clientSvcCall->addParameter("data", $data);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call(); //echo " STY List Users Enterprise : ".print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["listUsers"])) {
        $listUsers = $output["listUsers"];
        $_SESSION["DjangoSvcSecurity"]["StyListUsers"] = serialize($listUsers);
      }
      if (isset($output["listEnterprises"])) {
        $listEnterprises = $output["listEnterprises"];
        $_SESSION["DjangoSvcSecurity"]["StyListEnterprises"] = serialize($listEnterprises);
      }
      if (isset($output["listUsersTypes"])) {
        $listUsersTypes = $output["listUsersTypes"];
        $_SESSION["DjangoSvcSecurity"]["StyListUsersTypes"] = serialize($listUsersTypes);
      }
      if (isset($output["listRoles"])) {
        $listRoles = $output["listRoles"];
        $_SESSION["DjangoSvcSecurity"]["StyListRoles"] = serialize($listRoles);
      }
    }
    return array($listUsers, $listUsersTypes, $listEnterprises, $listRoles, $listLanguages);
  }
  // End of listUsersEnterprise

  public static function refreshSession($application = "", $user = "")
  {
    $logged = false;
    if (strlen($application) > 0 && strlen($user) > 0) {
      $data = new DjangoStyLoginData();
      $data->setApplication($application);
      $data->setLogin($user);
      $data->setAuthType(STY_AUTH_PASSWORD);
      $logged = self::refreshSess($data);
    }
    return $logged;
  }
  // End of refreshSession

  private static function refreshSess($data)
  {
    $outputok       = false;
    $output         = array();
    $layerData      = new DjangoSvcLayerData();
    $clientSvcCall  = new DjangoSvcCallerSty();
    $styInfoSession = new DjangoStyInfoSessionData();
    if (strlen($data->getAuthType()) > 0) {
      $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/RefreshSession/StyRefreshSessionDataSvc.php");
      $clientSvcCall->setMethodName("RefreshSession");
      $clientSvcCall->addParameter("data", $data);
      $clientSvcCall->setLayerData($layerData);
      list($outputok, $output) = $clientSvcCall->call();  //echo " STY Refresh Session : " . print_r($output);
      if ($outputok && !empty($output) > 0) {
        if (isset($output["StyInfoSession"])) {
          $styInfoSession = $output["StyInfoSession"];
          $_SESSION["DjangoSvcSecurity"]["StyUser"] = serialize($styInfoSession);
        }
        if (isset($output["StyUserRoles"])) {
          $styUserRoles = $output["StyUserRoles"];
          $_SESSION["DjangoSvcSecurity"]["StyUserRoles"] = serialize($styUserRoles);
        }
        if (isset($output["StyUserRights"])) {
          $styUserRights = $output["StyUserRights"];
          $_SESSION["DjangoSvcSecurity"]["StyUserRights"] = serialize($styUserRights);
        }
        if (isset($output["StyUserEnterprises"])) {
          $styUserEnterprises = $output["StyUserEnterprises"];
          $_SESSION["DjangoSvcSecurity"]["StyUserEnterprises"] = serialize($styUserEnterprises);
        }
        if (isset($output["StyEnterprises"])) {
          $styEnterprises = $output["StyEnterprises"];
          $_SESSION["DjangoSvcSecurity"]["StyEnterprises"] = serialize($styEnterprises);
        }
        if (isset($output["StyEnterprisePos"])) {
          $styEnterprisesPos = $output["StyEnterprisePos"];
          $_SESSION["DjangoSvcSecurity"]["StyEnterprisePos"] = serialize($styEnterprisesPos);
        }
      }
    }
    return self::isUserConnected();
  }
  // End of login

  public static function getIdUser()
  {
    $idUser = 0;
    if (isset($_SESSION["DjangoSvcSecurity"]["StyUser"])) {
      $userData  = unserialize($_SESSION["DjangoSvcSecurity"]["StyUser"]);
      $idUser = ($userData->getIdUser());
    }
    return $idUser;
  }
  // End of getIdUser

  public static function getIdLanguage()
  {
    $idLanguage = 0;
    if (isset($_SESSION["DjangoSvcSecurity"]["StyUser"])) {
      $userData  = unserialize($_SESSION["DjangoSvcSecurity"]["StyUser"]);
      $idLanguage = ($userData->getIdLanguage());
    }
    return $idLanguage;
  }
  // End of getIdLanguage

  public static function getIdCountry()
  {
    $idCountry = 0;
    if (isset($_SESSION["DjangoSvcSecurity"]["StyEnterprises"])) {
      $userData  = unserialize($_SESSION["DjangoSvcSecurity"]["StyEnterprises"]);
      for ($indE = 0; $indE < count($userData); $indE++) {
        if ($indE == 0) {
          $idCountry = $userData[$indE]->getIdCountry();
        }
      }
    }
    return $idCountry;
  }
  // End of getIdCountry

  public static function getIdPos()
  {
    $idPos = 0;
    if (isset($_SESSION["DjangoSvcSecurity"]["StyEnterprisePos"])) {
      $userData  = unserialize($_SESSION["DjangoSvcSecurity"]["StyEnterprisePos"]);
      for ($indEp = 0; $indEp < count($userData); $indEp++) {
        if ($indEp == 0) {
          $idPos = $userData[$indEp]->getIdPos();
        }
      }
    }
    return $idPos;
  }
  // End of getIdPos

  public static function findProfilShort($idUser = "", $email = "", $emailBackup = "")
  {
    $layerData           = new DjangoSvcLayerData();
    $clientSvcCall      = new DjangoSvcCallerSty();
    $outputok           = false;
    $output             = array();
    $styInfoSessionData = new DjangoStyInfoSessionData();
    $styInfoSessionData->setIdUser($idUser);
    $styInfoSessionData->setEmail($email);
    $styInfoSessionData->setEmailBackup($emailBackup);
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Profil/StyProfilDataSvc.php");
    $clientSvcCall->setMethodName("ProfilShort");
    $clientSvcCall->setLayerData($layerData);
    $clientSvcCall->addParameter("data", $styInfoSessionData);
    list($outputok, $output) = $clientSvcCall->call(); //print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["User"])) $styInfoSessionData = $output["User"];
    }
    return $styInfoSessionData;
  }

  public static function findProfil($idUser = "", $email = "", $emailBackup = "")
  {
    $layerData       = new DjangoSvcLayerData();
    $clientSvcCall  = new DjangoSvcCallerSty();
    $outputok       = false;
    $output         = array();
    $styInfoSessionData = new DjangoStyInfoSessionData();
    $styInfoSessionData->setIdUser($idUser);
    $styInfoSessionData->setEmail($email);
    $styInfoSessionData->setEmailBackup($emailBackup);
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Profil/StyProfilDataSvc.php");
    $clientSvcCall->setMethodName("Profil");
    $clientSvcCall->setLayerData($layerData);
    $clientSvcCall->addParameter("data", $styInfoSessionData);
    list($outputok, $output) = $clientSvcCall->call(); //print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["User"])) $styInfoSessionData = $output["User"];
    }
    return $styInfoSessionData;
  }

  public static function findProfilByLogin($login = "")
  {
    $layerData       = new DjangoSvcLayerData();
    $clientSvcCall  = new DjangoSvcCallerSty();
    $outputok       = false;
    $output         = array();
    $styInfoSessionData = new DjangoStyInfoSessionData();
    $styInfoSessionData->setLogin($login);
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Profil/StyProfilDataSvc.php");
    $clientSvcCall->setMethodName("Profil");
    $clientSvcCall->addParameter("data", $styInfoSessionData);  //print_r($styInfoSessionData);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call();          //print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["User"])) $styInfoSessionData = $output["User"];
    }
    return $styInfoSessionData;
  }

  public static function findProfilByMail($mail = "")
  {
    $layerData       = new DjangoSvcLayerData();
    $clientSvcCall  = new DjangoSvcCallerSty();
    $outputok       = false;
    $output         = array();
    $styInfoSessionData = new DjangoStyInfoSessionData();
    $styInfoSessionData->setEmail($mail);
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Profil/StyProfilDataSvc.php");
    $clientSvcCall->setMethodName("Profil");
    $clientSvcCall->addParameter("data", $styInfoSessionData);  //print_r($styInfoSessionData);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call();          //print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["User"])) $styInfoSessionData = $output["User"];
    }
    return $styInfoSessionData;
  }

  public static function loginForgetPassword($application = "", $idLanguage = 1, $email = "", $emailBackup = "", $phone = "", $mobile = "")
  {
    $data = new DjangoStyForgetPassData();
    if (strlen($application) > 0 && (strlen($email) > 0 || strlen($emailBackup) > 0 || strlen($phone) > 0 || strlen($mobile) > 0)) {
      $data->setApplication($application);
      $data->setIdLanguage($idLanguage);
      $data->setEmail($email);
      $data->setEmailBackup($emailBackup);
      $data->setPhone($phone);
      $data->setMobile($mobile);
      $data = self::forgetPassword($data);
    }
    return $data;
  }
  // End of loginForgetPassword

  public static function forgetPassword($data)
  {
    $outputok           = false;
    $output             = array();
    $styForgetPassData  = new DjangoStyForgetPassData();
    $layerData           = new DjangoSvcLayerData();
    $clientSvcCall      = new DjangoSvcCallerSty();
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Login/StyLoginDataSvc.php");
    $clientSvcCall->setMethodName("ForgetPassword");
    $clientSvcCall->addParameter("data", $data);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call(); //print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["ForgetPasssword"])) $styForgetPassData = $output["ForgetPasssword"]->getData();
    }
    return $styForgetPassData;
  }
  // End of forgetPassword

  public static function loginChangePassword($application = "", $idLanguage = "1",  $idUser = "0", $login = "", $email = "", $currentPassword = "", $newPassword = "")
  {
    $passwordChanged = false;
    if (strlen($application) > 0 && ($idUser > 0 || strlen($email) > 0 || strlen($login) > 0) && (strlen($currentPassword) > 0 || strlen($newPassword) > 0)) {
      $data = new DjangoStyForgetPassData();
      $data->setApplication($application);
      $data->setIdUser($idUser);
      $data->setIdLanguage($idLanguage);
      $data->setEmail($email);
      $data->setLogin($login);
      $currentPassword = DjangoStyCrypto::cryptOneWay(trim($currentPassword));
      $data->setCurrentPassword($currentPassword);
      $newPassword = DjangoStyCrypto::cryptOneWay(trim($newPassword));
      $data->setNewPassword($newPassword);
      $passwordChanged = self::changePassword($data);
    }
    return $passwordChanged;
  }
  // End of loginChangePassword

  public static function changePassword($data)
  {
    $outputok         = false;
    $passwordChanged  = false;
    $error            = new AppErrorSvcData();
    $output           = array();
    $layerData        = new DjangoSvcLayerData();
    $clientSvcCall    = new DjangoSvcCallerSty();
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/ChangePassword/StyChangePasswordDataSvc.php");
    $clientSvcCall->setMethodName("ChangePassword");
    $clientSvcCall->addParameter("data", $data);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call();
    echo " STY ChangePassword : " . print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["PasswordChanged"])) {
        $passwordChanged  = $output["PasswordChanged"];
        $error            = $output["Error"];
      }
    }
    return array($passwordChanged, $error);
  }
  // End of changePassword

  public static function userInitPassword($application = "", $idLanguage = "1",  $idUser = "0", $login = "", $email = "", $emailBackup = '')
  {
    $passwordInit = false;
    if (strlen($application) > 0 && ($idUser > 0 || strlen($login) > 0 || strlen($email) > 0 || strlen($emailBackup) > 0)) {
      $data = new DjangoStyInitPassData();
      $data->setApplication($application);
      $data->setIdUser($idUser);
      $data->setIdLanguage($idLanguage);
      $data->setLogin($login);
      $data->setEmail($email);
      $data->setEmailBackUp($emailBackup);
      $passwordInit = self::initPassword($data);
    }
    return $passwordInit;
  }
  // End of loginInitPassword

  public static function initPassword($data)
  {
    $outputok       = false;
    $passwordInit   = false;
    $output         = array();
    $layerData      = new DjangoSvcLayerData();
    $clientSvcCall  = new DjangoSvcCallerSty();
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/InitPassword/StyInitPasswordDataSvc.php");
    $clientSvcCall->setMethodName("InitPassword");
    $clientSvcCall->addParameter("data", $data);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call(); //echo " STY Login : ".print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["PasswordInit"])) $passwordInit = $output["PasswordInit"];
    }
    return $passwordInit;
  }
  // End of initPassword

  public static function saveUser($application, $data)
  {
    $confirmSaveUser  = false;
    $appErrorSvcData  = new AppErrorSvcData();
    $djangoSty        = new DjangoStyInitPassData();
    $djangoSty->setApplication($application);

    $outputok      = false;
    $output        = array();
    $layerData     = new DjangoSvcLayerData();
    $clientSvcCall = new DjangoSvcCallerSty();
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Users/StyUsersDataSvc.php");
    $clientSvcCall->setMethodName("SaveUser");
    $clientSvcCall->addParameter("djangoSty", $djangoSty);    //print_r($djangoSty);
    $clientSvcCall->addParameter("data", $data);              //print_r($data);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call();        //echo " STY Save User : ".print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["ConfirmSaveUser"])) {
        $confirmSaveUser = $output["ConfirmSaveUser"];
        $appErrorSvcData = $output["Error"];
      }
    }
    return array($confirmSaveUser, $appErrorSvcData);
  }
  // End of saveUser

  public static function delUser($application, $data)
  {
    $djangoSty = new DjangoStyInitPassData();
    $djangoSty->setApplication($application);

    $confirmDelUser = false;
    $outputok       = false;
    $output         = array();
    $layerData      = new DjangoSvcLayerData();
    $clientSvcCall  = new DjangoSvcCallerSty();
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Users/StyUsersDataSvc.php");
    $clientSvcCall->setMethodName("DelUser");
    $clientSvcCall->addParameter("djangoSty", $djangoSty);
    print_r($djangoSty);
    $clientSvcCall->addParameter("data", $data);
    print_r($data);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call();
    echo " STY Delete User : " . print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["ConfirmDelUser"])) $confirmDelUser = $output["ConfirmDelUser"];
    }
    return $confirmDelUser;
  }
  // End of delUser

  public static function restoreUser($application, $data)
  {
    $djangoSty = new DjangoStyInitPassData();
    $djangoSty->setApplication($application);

    $outputok           = false;
    $output             = array();
    $layerData          = new DjangoSvcLayerData();
    $clientSvcCall      = new DjangoSvcCallerSty();
    $confirmRestoreUser = false;
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Users/StyUsersDataSvc.php");
    $clientSvcCall->setMethodName("RestoreUser");
    $clientSvcCall->addParameter("djangoSty", $djangoSty);
    $clientSvcCall->addParameter("data", $data);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call(); //echo " STY Restore User : ".print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["ConfirmRestoreUser"])) $confirmRestoreUser = $output["ConfirmRestoreUser"];
    }
    return $confirmRestoreUser;
  }
  // End of restoreUser

  public static function logout()
  {
    if (isset($_SESSION["DjangoSvcSecurity"]["StyUser"])) unset($_SESSION["DjangoSvcSecurity"]['StyUser']);
    if (isset($_SESSION["DjangoSvcSecurity"]["StyUserRoles"])) unset($_SESSION["DjangoSvcSecurity"]['StyUserRoles']);
    if (isset($_SESSION["DjangoSvcSecurity"]["StyUserRights"])) unset($_SESSION["DjangoSvcSecurity"]['StyUserRights']);

    if (isset($_SESSION["DjangoSvcSecurity"]["StyListUsers"])) unset($_SESSION["DjangoSvcSecurity"]["StyListUsers"]);
    if (isset($_SESSION["DjangoSvcSecurity"]["StyListEnterprises"])) unset($_SESSION["DjangoSvcSecurity"]["StyListEnterprises"]);
    if (isset($_SESSION["DjangoSvcSecurity"]["StyListUsersTypes"])) unset($_SESSION["DjangoSvcSecurity"]["StyListUsersTypes"]);
    if (isset($_SESSION["DjangoSvcSecurity"]["StyListRoles"])) unset($_SESSION["DjangoSvcSecurity"]["StyListRoles"]);
    if (isset($_SESSION["DjangoSvcSecurity"]["StyListRolesRights"])) unset($_SESSION["DjangoSvcSecurity"]["StyListRolesRights"]);
  }
  // End of logout

  public function getStySession()
  {
    return $this->stySession;
  }
  // End of getStySession

  public static function getStyListRolesRightsInfos()
  {
    $rolesRightsList      = array();
    $rolesRightsListInd = 0;
    $rolesRightsListInfos = new DjangoStyUserData();
    if (isset($_SESSION["DjangoSvcSecurity"]["StyListRolesRights"])) {
      $rolesRightsListInfos    = unserialize($_SESSION["DjangoSvcSecurity"]["StyListRolesRights"]);
      $rolesRightsListInfosInd = 0;
      if (!empty($rolesRightsListInfos)) $rolesRightsListInfosInd = count($rolesRightsListInfos);
      for ($indRr = 0; $indRr < $rolesRightsListInfosInd; $indRr++) {
        $styRolesRightsInfos = new DjangoStyRolesRightsCompletData();
        $styRolesRightsInfos->setId($rolesRightsListInfos[$indRr]->getId());
        $styRolesRightsInfos->setIdUser($rolesRightsListInfos[$indRr]->getIdUser());
        $styRolesRightsInfos->setIdStyRole($rolesRightsListInfos[$indRr]->getIdStyRole());
        $styRolesRightsInfos->setNameStyRole($rolesRightsListInfos[$indRr]->getNameStyRole());
        $styRolesRightsInfos->setApplications($rolesRightsListInfos[$indRr]->getApplications());
        $styRolesRightsInfos->setStatus($rolesRightsListInfos[$indRr]->getStatus());
        $rolesRightsList[$rolesRightsListInd++] = $styRolesRightsInfos;
      }
    }
    return $rolesRightsList;
  }
  // End of getStyListRolesRightsInfos

  public static function getStyListUsersInfos()
  {
    $userList       = array();
    $userListInd = 0;
    $userListInfos  = new DjangoStyUserData();
    if (isset($_SESSION["DjangoSvcSecurity"]["StyListUsers"])) {
      $userListInfos    = unserialize($_SESSION["DjangoSvcSecurity"]["StyListUsers"]);
      $userListInfosInd = 0;
      if (!empty($userListInfos)) $userListInfosInd = count($userListInfos);
      for ($indR = 0; $indR < $userListInfosInd; $indR++) {
        $styUserInfos = new DjangoStyUserData();
        $styUserInfos->setId($userListInfos[$indR]->getId());
        $styUserInfos->setIdStyUserType($userListInfos[$indR]->getIdStyUserType());
        $styUserInfos->setLogin($userListInfos[$indR]->getLogin());
        $styUserInfos->setFirstName($userListInfos[$indR]->getFirstName());
        $styUserInfos->setName($userListInfos[$indR]->getName());
        $styUserInfos->setLinkToPicture($userListInfos[$indR]->getLinkToPicture());
        $styUserInfos->setPass($userListInfos[$indR]->getPass());
        $styUserInfos->setEmail($userListInfos[$indR]->getEmail());
        $styUserInfos->setEmailBackup($userListInfos[$indR]->getEmailBackup());
        $styUserInfos->setPhone($userListInfos[$indR]->getPhone());
        $styUserInfos->setMobile($userListInfos[$indR]->getMobile());
        $styUserInfos->setInitPass($userListInfos[$indR]->getInitPass());
        $styUserInfos->setIdLanguage($userListInfos[$indR]->getIdLanguage());
        $styUserInfos->setIdStyEnterprise($userListInfos[$indR]->getIdStyEnterprise());
        $styUserInfos->setRoles($userListInfos[$indR]->getRoles());                   // Nico : Must loop for all Roles by Users
        $styUserInfos->setStatus($userListInfos[$indR]->getStatus());
        $userList[$userListInd++] = $styUserInfos;
      }
    }
    return $userList;
  }
  // End of getStyListUsersInfos

  public static function getStyListEnterprisesInfos()
  {
    $enterprisesList      = array();
    $enterprisesListInd = 0;
    $enterprisesListInfos = new DjangoStyEnterpriseData();
    if (isset($_SESSION["DjangoSvcSecurity"]["StyListEnterprises"])) {
      $enterprisesListInfos     = unserialize($_SESSION["DjangoSvcSecurity"]["StyListEnterprises"]);
      $enterprisesListInfosInd  = 0;
      if (!empty($enterprisesListInfos)) $enterprisesListInfosInd = count($enterprisesListInfos);
      for ($indR = 0; $indR < $enterprisesListInfosInd; $indR++) {
        $styEnterprisesInfos = new DjangoStyEnterpriseData();
        $styEnterprisesInfos->setId($enterprisesListInfos[$indR]->getId());
        $styEnterprisesInfos->setCode($enterprisesListInfos[$indR]->getCode());
        $styEnterprisesInfos->setName($enterprisesListInfos[$indR]->getName());
        $styEnterprisesInfos->setEmail($enterprisesListInfos[$indR]->getEmail());
        $styEnterprisesInfos->setPhone($enterprisesListInfos[$indR]->getPhone());
        $styEnterprisesInfos->setMobile($enterprisesListInfos[$indR]->getMobile());
        $styEnterprisesInfos->setCo($enterprisesListInfos[$indR]->getCo());
        $styEnterprisesInfos->setStreet($enterprisesListInfos[$indR]->getStreet());
        $styEnterprisesInfos->setZipCode($enterprisesListInfos[$indR]->getZipCode());
        $styEnterprisesInfos->setCity($enterprisesListInfos[$indR]->getCity());
        $styEnterprisesInfos->setLogoImage($enterprisesListInfos[$indR]->getLogoImage());
        $styEnterprisesInfos->setLogoImageHtmlName($enterprisesListInfos[$indR]->getLogoImageHtmlName());
        $styEnterprisesInfos->setLogoImageName($enterprisesListInfos[$indR]->getLogoImageName());
        $styEnterprisesInfos->setLogoSize($enterprisesListInfos[$indR]->getLogoSize());
        $styEnterprisesInfos->setLogoType($enterprisesListInfos[$indR]->getLogoType());
        $styEnterprisesInfos->setIdRegion($enterprisesListInfos[$indR]->getIdRegion());
        $styEnterprisesInfos->setIdCountry($enterprisesListInfos[$indR]->getIdCountry());
        $styEnterprisesInfos->setIdLanguage($enterprisesListInfos[$indR]->getIdLanguage());
        $styEnterprisesInfos->setIdUserManager($enterprisesListInfos[$indR]->getIdUserManager());
        $styEnterprisesInfos->setNameUserManager($enterprisesListInfos[$indR]->getNameUserManager());
        $styEnterprisesInfos->setFirstNameUserManager($enterprisesListInfos[$indR]->getFirstNameUserManager());
        $styEnterprisesInfos->setImgUserManager($enterprisesListInfos[$indR]->getImgUserManager());
        $styEnterprisesInfos->setMailUserManager($enterprisesListInfos[$indR]->getMailUserManager());
        $styEnterprisesInfos->setPhoneUserManager($enterprisesListInfos[$indR]->getPhoneUserManager());
        $styEnterprisesInfos->setMobileUserManager($enterprisesListInfos[$indR]->getMobileUserManager());
        $styEnterprisesInfos->setIdStyEnterpriseParent($enterprisesListInfos[$indR]->getIdStyEnterpriseParent());
        $styEnterprisesInfos->setStatut($enterprisesListInfos[$indR]->getStatut());
        $enterprisesList[$enterprisesListInd++] = $styEnterprisesInfos;
      }
    }
    return $enterprisesList;
  }
  // End of getStyListEnterprisesInfos

  public static function getStyListUsersTypesInfos()
  {
    $usersTypesList       = array();
    $usersTypesListInd = 0;
    $usersTypesListInfos  = new DjangoStyUserTypesData();
    if (isset($_SESSION["DjangoSvcSecurity"]["StyListUsersTypes"])) {
      $usersTypesListInfos    = unserialize($_SESSION["DjangoSvcSecurity"]["StyListUsersTypes"]);
      $usersTypesListInfosInd = 0;
      if (!empty($usersTypesListInfos)) $usersTypesListInfosInd = count($usersTypesListInfos);
      for ($indR = 0; $indR < $usersTypesListInfosInd; $indR++) {
        $styUsersTypesInfos = new DjangoStyUserTypesData();
        $styUsersTypesInfos->setId($usersTypesListInfos[$indR]->getId());
        $styUsersTypesInfos->setName($usersTypesListInfos[$indR]->getName());
        $usersTypesList[$usersTypesListInd++] = $styUsersTypesInfos;
      }
    }
    return $usersTypesList;
  }
  // End of getStyListUsersTypesInfos

  public static function getStyListRolesInfos()
  {
    $rolesList      = array();
    $rolesListInd = 0;
    $rolesListInfos = new DjangoStyRolesData();
    if (isset($_SESSION["DjangoSvcSecurity"]["StyListRoles"])) {
      $rolesListInfos     = unserialize($_SESSION["DjangoSvcSecurity"]["StyListRoles"]);
      $rolesListInfosInd  = 0;
      if (!empty($rolesListInfos)) $rolesListInfosInd = count($rolesListInfos);
      for ($indR = 0; $indR < $rolesListInfosInd; $indR++) {
        $styRolesInfos = new DjangoStyRolesData();
        $styRolesInfos->setIdStyRole($rolesListInfos[$indR]->getIdStyRole());
        $styRolesInfos->setCodeStyRole($rolesListInfos[$indR]->getCodeStyRole());
        $styRolesInfos->setNameStyRole($rolesListInfos[$indR]->getNameStyRole());
        $rolesList[$rolesListInd++] = $styRolesInfos;
      }
    }
    return $rolesList;
  }
  // End of getStyListRolesInfos

  public static function getStyUserRoleInfos()
  {
    $userRoles      = array();
    $userRolesInd = 0;
    $userRolesInfos = new DjangoStyUserRolesData();
    if (isset($_SESSION["DjangoSvcSecurity"]["StyUserRoles"])) {
      $userRolesInfos     = unserialize($_SESSION["DjangoSvcSecurity"]["StyUserRoles"]);
      $userRolesInfosInd  = 0;
      if (!empty($userRolesInfos)) $userRolesInfosInd = count($userRolesInfos);
      for ($indR = 0; $indR < $userRolesInfosInd; $indR++) {
        $styUserRolesInfos = new DjangoStyUserRolesData();
        $styUserRolesInfos->setIdUser($userRolesInfos[$indR]->getIdUser());
        $styUserRolesInfos->setIdStyRole($userRolesInfos[$indR]->getIdStyRole());
        $styUserRolesInfos->setNameStyRole($userRolesInfos[$indR]->getNameStyRole());
        $userRoles[$userRolesInd++] = $styUserRolesInfos;
      }
    }
    return $userRoles;
  }
  // End of getStyUserRoleInfos

  public static function getStyUserInfos()
  {
    $userInfos = new DjangoStyInfoSessionData();
    if (isset($_SESSION["DjangoSvcSecurity"]["StyUser"])) {
      $userInfos  = unserialize($_SESSION["DjangoSvcSecurity"]["StyUser"]);
    }
    return $userInfos;
  }
  // End of getStyUserInfos

  public static function getStyUserEnterprises()
  {
    $userEnterprises = array();
    if (isset($_SESSION["DjangoSvcSecurity"]["StyUserEnterprises"])) {
      $userEnterprises = unserialize($_SESSION["DjangoSvcSecurity"]["StyUserEnterprises"]);
    }
    return $userEnterprises;
  }
  // End of getStyUserEnterprises

  public static function getStyUserEnterprisePos()
  {
    $styEnterprisePos = array();
    if (isset($_SESSION["DjangoSvcSecurity"]["StyEnterprisePos"])) {
      $styEnterprisePos = unserialize($_SESSION["DjangoSvcSecurity"]["StyEnterprisePos"]);
    }
    return $styEnterprisePos;
  }
  // End of getStyUserEnterprisePos

  public static function hasRight($right = 0, $app = "", $module = "", $functionality = "")
  {
    $hasRight = false;
    if ($right > 0 && $app != "") {
      if (isset($_SESSION["DjangoSvcSecurity"]["StyUserRights"])) {
        $userRights = unserialize($_SESSION["DjangoSvcSecurity"]["StyUserRights"]);
        $userRightsInd = 0;
        if (!empty($userRights)) $userRightsInd = count($userRights);
        for ($indR = 0; $indR < $userRightsInd && !$hasRight; $indR++) {
          $dataRight = $userRights[$indR];
          if (
            $dataRight->getApplicationCode() == $app &&
            ($dataRight->getModuleCode() == $module || $module == "") &&
            ($dataRight->getFunctionalityCode() == $functionality || $functionality == "")
          ) {
            $calc = $dataRight->getSumOfRights();
            $hasRight = ($calc >= $right || $calc == STY_RIGHT_MANAGE);
            // les droits sont-ils assez élevés pour le droit recheché  or Full Power User ?
            if ($hasRight && $calc != STY_RIGHT_MANAGE) {
              $calc -= $right;
              //echo "hasRight#@calc - right #$calc<br/>";
              if ($calc == 0) $hasRight = true; // Seulement un droit et celui recherché
              else {
                $i = STY_RIGHT_MAX;
                while ($i >= STY_RIGHT_MIN) {
                  if ($calc >= $i && $i != $right) { // Droit mixé avec d'autres droits ?
                    $calc -= $i;
                  }
                  $i = $i / 2;
                }
              }
              $hasRight = ($calc == 0);
            }
          }
        }
      }
    }
    return;
  }
  // End of hasRight

  public static function hasAnyRight($app = "", $module = "", $functionality = "")
  {
    $hasRight = false;
    if ($app != "") {
      if (isset($_SESSION["DjangoSvcSecurity"]["StyUserRights"])) {
        $userRights = unserialize($_SESSION["DjangoSvcSecurity"]["StyUserRights"]);
        $userRightsInd = 0;
        if (!empty($userRights)) $userRightsInd = count($userRights);
        for ($indR = 0; $indR < $userRightsInd && !$hasRight; $indR++) {
          $dataRight = $userRights[$indR];
          if (
            $dataRight->getApplicationCode() == $app &&
            ($dataRight->getModuleCode() == $module || $module == "") &&
            ($dataRight->getFunctionalityCode() == $functionality || $functionality == "")
          ) {
            $hasRight = true;
          }
        }
      }
    }
    return $hasRight;
  }
  // End of hasAnyRight

  public static function getRightView()
  {
    return STY_RIGHT_VIEW;
  }
  public static function getRightChange()
  {
    return STY_RIGHT_CHANGE;
  }
  public static function getRightAdd()
  {
    return STY_RIGHT_ADD;
  }
  public static function getRightRemove()
  {
    return STY_RIGHT_REMOVE;
  }
  public static function getRightDelete()
  {
    return STY_RIGHT_DELETE;
  }
  public static function getRightPrint()
  {
    return STY_RIGHT_PRINT;
  }
  public static function getRightList()
  {
    return STY_RIGHT_LIST;
  }
  public static function getRightFollow()
  {
    return STY_RIGHT_FOLLOW;
  }
  public static function getRightSecurity()
  {
    return STY_RIGHT_SECURITY;
  }
  public static function getRightPublish()
  {
    return STY_RIGHT_PUBLISH;
  }
  public static function getRightRestore()
  {
    return STY_RIGHT_RESTORE;
  }
  public static function getRightDuplicate()
  {
    return STY_RIGHT_DUPLICATE;
  }
  public static function getRightAgenda()
  {
    return STY_RIGHT_AGENDA;
  }
  public static function getRightUse()
  {
    return STY_RIGHT_USE;
  }
  public static function getRightManage()
  {
    return STY_RIGHT_MANAGE;
  }
}

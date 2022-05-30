<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../Data/DistriXStyEnterpriseData.php");
include(__DIR__ . "/../Data/DistriXStyEnterprisePosData.php");
include(__DIR__ . "/../Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../Data/DistriXStyLoginData.php");
include(__DIR__ . "/../Data/DistriXStyUserEnterpriseData.php");
include(__DIR__ . "/../Data/DistriXStyUserRightsData.php");
include(__DIR__ . "/../Data/DistriXStyUserRolesData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");

// ------------------------------------
// -----------L O G G E R ---------------
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

class DistriXStyUser
{
  public static function isUserConnected(): bool
  {
    $connected = false;
    if (isset($_SESSION["DistriXSvcSecurity"]["StyUser"])) {
      $userData  = unserialize($_SESSION["DistriXSvcSecurity"]["StyUser"]);
      $connected = ($userData->getConnected());
    }
    return $connected;
  }
  // End of isUserConnected

  public static function getUserInformation(): DistriXStyInfoSessionData
  {
    $userData = new DistriXStyInfoSessionData();
    if (isset($_SESSION["DistriXSvcSecurity"]["StyUser"])) {
      $userData = unserialize($_SESSION["DistriXSvcSecurity"]["StyUser"]);
    }
    return $userData;
  }
  // End of getUserInformation

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

  public static function listUsers($idStyEnterprise = "")
  {
    $listUsers  = array();
    $data       = new DistriXStyUserData();
    if ($idStyEnterprise > 0) {
      $data->setIdStyEnterprise($idStyEnterprise);
    }
    list($data, $errorJson) = DistriXStyUserData::getJsonData($data);
    $listUsers = self::listUsersEnterprise($data);
    return $listUsers;
  }
  // End of listUsers 

  public static function listUsersEnterprise(DistriXStyUserData $data): array
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ListUsers");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyUserListDataSvc.php");
    $styServicesCaller->addParameter("data", $data);
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserListDataSvc");
      $logInfoData->setLogFunction("listUsersEnterprise");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ListUsers"])) {
        $return = $output["ListUsers"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listUsersEnterprise

  public static function viewUser($idUser = "")
  {
    $user  = new DistriXStyUserData();
    if ($idUser > 0) {
      $user->setId($idUser);
      $user = self::user($user);
    }
    return $user;
  }
  // End of viewUser 

  public static function findUserByEmail($email = "")
  {
    $user  = new DistriXStyUserData();
    if ($email != '') {
      $user->setEmail($email);
      $user = self::user($user);
    }
    return $user;
  }
  // End of findUserByEmail 

  public static function findUserByEmailBackup($emailBackup = "")
  {
    $user  = new DistriXStyUserData();
    if ($emailBackup != '') {
      $user->setEmailBackup($emailBackup);
      $user = self::user($user);
    }
    return $user;
  }
  // End of findUserByEmailBackup 

  public static function user(DistriXStyUserData $user): object
  {
    $outputok          = false;
    $output            = array();
    $return            = new DistriXStyUserData();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewUser");
    $styServicesCaller->addParameter("data", $user);                    //print_r($user);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyUserViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();  //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserViewDataSvc");
      $logInfoData->setLogFunction("user");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewUser"])) {
        $return = $output["ViewUser"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listUser


  public static function saveUser(DistriXStyInfoSessionData $data): array
  {
    $outputok          = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveUser");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyProfilSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    // Must manager $errorData. Yvan 23-Feb-22
    $logInfoData = new DistriXLoggerInfoData();
    $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
    $logInfoData->setLogApplication("DistriXStyAppInterface");
    $logInfoData->setLogFunction("saveUser");
    $logInfoData->setLogData(print_r($output, true));
    // DistriXLogger::log(__DIR__ . "/../DistriXLoggerSettings.php", $logInfoData);

    if ($outputok && !empty($output) > 0) {
      $_SESSION["DistriXSvcSecurity"]["StyUser"]            = serialize($output["StyInfoSession"]);
      $_SESSION["DistriXSvcSecurity"]["StyUserRoles"]       = serialize($output["StyUserRoles"]);
      $_SESSION["DistriXSvcSecurity"]["StyUserRights"]      = serialize($output["StyUserRights"]);
      $_SESSION["DistriXSvcSecurity"]["StyUserEnterprises"] = serialize($output["StyUserEnterprises"]);
      $_SESSION["DistriXSvcSecurity"]["StyEnterprises"]     = serialize($output["StyEnterprises"]);
      $_SESSION["DistriXSvcSecurity"]["StyEnterprisePos"]   = serialize($output["StyEnterprisePos"]);
    }

    $confirmSaveUser  = false;

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

  // public static function saveUser($application, $data): array
  // {
  //   $confirmSaveUser  = false;
  //   $appErrorSvcData  = new AppErrorSvcData();
  //   $djangoSty        = new DjangoStyInitPassData();
  //   $djangoSty->setApplication($application);

  //   $outputok      = false;
  //   $output        = array();
  //   $layerData     = new DjangoSvcLayerData();
  //   $clientSvcCall = new DjangoSvcCallerSty();
  //   $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Users/StyUsersDataSvc.php");
  //   $clientSvcCall->setMethodName("SaveUser");
  //   $clientSvcCall->addParameter("djangoSty", $djangoSty);    //print_r($djangoSty);
  //   $clientSvcCall->addParameter("data", $data);              //print_r($data);
  //   $clientSvcCall->setLayerData($layerData);
  //   list($outputok, $output) = $clientSvcCall->call();        //echo " STY Save User : ".print_r($output);
  //   if ($outputok && !empty($output) > 0) {
  //     if (isset($output["ConfirmSaveUser"])) {
  //       $confirmSaveUser = $output["ConfirmSaveUser"];
  //       $appErrorSvcData = $output["Error"];
  //     }
  //   }
  //   return array($confirmSaveUser, $appErrorSvcData);
  // }
  // // End of saveUser

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
}

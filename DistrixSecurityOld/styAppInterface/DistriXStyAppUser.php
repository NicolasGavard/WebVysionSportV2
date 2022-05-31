<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyUserData.php");
include(__DIR__ . "/../Data/DistriXStyInfoSessionData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../DistrixCrypto/DistriXCrypto.php");
// DistriX LOGGER
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

  public static function saveUser(DistriXStyUserData $data): array
  {   
    $outputok          = false;
    $confirmSaveUser   = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveUser");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyUserSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserSaveDataSvc");
      $logInfoData->setLogFunction("saveUser");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveUser  = $output['ConfirmSaveUser'];
    }
    return array($confirmSaveUser, $errorData);
  }
  // End of saveUser
  
  public static function savePassUser(DistriXStyUserData $data): array
  {
    $outputok          = false;
    $confirmSaveUser   = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SavePassUser");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyUserSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserSaveDataSvc");
      $logInfoData->setLogFunction("savePassUser");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveUser  = $output['ConfirmSaveUser'];
    }
    return array($confirmSaveUser, $errorData);
  }
  // End of saveUser

  public static function delUser(DistriXStyUserData $data): array
  {
    $outputok          = false;
    $confirmDelUser    = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelUser");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyUserDeleteDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserDeleteDataSvc");
      $logInfoData->setLogFunction("delUser");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelUser  = $output['ConfirmSaveUser'];
    }
    return array($confirmDelUser, $errorData);
  }
  // End of delUser

  public static function restoreUser(DistriXStyUserData $data): array
  {
    $outputok          = false;
    $confirmRestoreUser= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("RestoreUser");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyUserRestoreDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserRestoreDataSvc");
      $logInfoData->setLogFunction("restoreUser");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmRestoreUser  = $output['ConfirmSaveUser'];
    }
    return array($confirmRestoreUser, $errorData);
  }
  // End of restoreUser
  
  public static function sendMailForgetPassword(DistriXStyUserData $data): array
  {
    $outputok          = false;
    $confirmSendMail   = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SendMailForgetPassword");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyUserSendMailForgetPassordDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();        //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserSendMailForgetPassordDataSvc");
      $logInfoData->setLogFunction("sendMailForgetPassword");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSendMail  = $output['ConfirmSendMail'];
    }
    return array($confirmSendMail, $errorData);
  }
  // End of sendMailForgetPassword
}

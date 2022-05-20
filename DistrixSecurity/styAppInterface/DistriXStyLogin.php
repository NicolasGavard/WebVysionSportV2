<?php // Needed to encode in UTF8 ààéàé //
// Constants
include(__DIR__ . "/../Const/DistriXStyAuthenticationConst.php");
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
include(__DIR__ . "/../../DistriXLogger/Data/DistriXLoggerInfoData.php");

class DistriXStyLogin
{
  public static function loginPassword(string $application, string $user, string $password): bool
  {
    $logged = false;
    if (strlen($application) > 0 && strlen($user) > 0 && strlen($password) > 0) {
      $data = new DistriXStyLoginData();
      $data->setApplication($application);
      $data->setLogin($user);
      $pwd = DistriXCrypto::encodeOneWay(trim($password));
      $data->setPassword(trim($pwd));
      $data->setAuthType(DISTRIX_STY_AUTH_PASSWORD);
      $logged = self::login($data);
    }
    return $logged;
  }
  // End of loginPassword

  private static function login(DistriXStyLoginData $data): bool
  {
    if (strlen($data->getAuthType()) > 0) {
      $outputok          = false;
      $output            = array();
      $styServicesCaller = new DistriXStySvcCaller();
      $styServicesCaller->addParameter("data", $data);                  print_r($data);
      $styServicesCaller->setMethodName("Login");
      $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Login/DistriXStyLoginBusSvc.php");
      list($outputok, $output, $errorData) = $styServicesCaller->call(); print_r($output);

      if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
        $logInfoData = new DistriXLoggerInfoData();
        $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
        $logInfoData->setLogApplication("DistriXStyLoginBusSvc");
        $logInfoData->setLogFunction("login");
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
    }
    return self::isUserConnected();
  }
  // End of login

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

  public static function logout()
  {
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
    return true;
  }
  // End of logout
}

<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyUserRoleData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../DistrixCrypto/DistriXCrypto.php");
// DistriX LOGGER
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

class DistriXStyAppUserRole
{
  public static function viewUserRole($idUser = "")
  {
    $userRole  = new DistriXStyUserRoleData();
    if ($idUser > 0) {
      $userRole->setIdStyUser($idUser);
      $userRole = self::userRole($userRole);
    }
    return $userRole;
  }
  // End of viewUserRole 

  public static function userRole(DistriXStyUserRoleData $userRole): object
  {
    $outputok          = false;
    $output            = array();
    $return            = new DistriXStyUserRoleData();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewUserRole");
    $styServicesCaller->addParameter("data", $userRole);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/UserRole/DistriXStyUserRoleViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserRoleViewDataSvc");
      $logInfoData->setLogFunction("userRole");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewUserRole"])) {
        $return = $output["ViewUserRole"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of userRole
  
  public static function viewAllUserByRole($idRole = "")
  {
    $userRole  = new DistriXStyUserRoleData();
    if ($idRole > 0) {
      $userRole->setIdStyRole($idRole);
      $userRole = self::allUserRoleByRole($userRole);
    }
    return $userRole;
  }
  // End of viewUserRole 

  public static function allUserRoleByRole(DistriXStyUserRoleData $userRole): array
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewUserRole");
    $styServicesCaller->addParameter("data", $userRole);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/UserRole/DistriXStyUserRoleViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserRoleViewDataSvc");
      $logInfoData->setLogFunction("allUserRoleByRole");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ListAllUserByRole"])) {
        $return = $output["ListAllUserByRole"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of allUserRoleByRole

  public static function saveUserRole(DistriXStyUserRoleData $data): array
  {
    $outputok           = false;
    $confirmSaveUserRole= false;
    $output             = array();
    $styServicesCaller  = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveUserRole");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyUserRoleSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserRoleSaveDataSvc");
      $logInfoData->setLogFunction("saveUserRole");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveUserRole  = $output['ConfirmSaveUserRole'];
    }
    return array($confirmSaveUserRole, $errorData);
  }
  // End of saveUserRole
  
  public static function delUserRole(DistriXStyUserRoleData $data): array
  {
    $outputok          = false;
    $confirmDelUserRole= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelUserRole");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyUserRoleDeleteDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserRoleDeleteDataSvc");
      $logInfoData->setLogFunction("delUserRole");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelUserRole  = $output['ConfirmSaveUserRole'];
    }
    return array($confirmDelUserRole, $errorData);
  }
  // End of delUserRole
}

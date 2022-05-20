<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyRoleData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");

// ------------------------------------
// -----------L O G G E R ---------------
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

class DistriXStyRole
{
  public static function listRoles(): array
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ListRoles");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Role/DistriXStyRoleListDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRoleListDataSvc");
      $logInfoData->setLogFunction("listRoles");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ListRoles"])) {
        $return = $output["ListRoles"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listRole

  public static function viewRole($id = "")
  {
    $role  = new DistriXStyRoleData();
    if ($id > 0) {
      $role->setId($id);
      $role = self::role($role);
    }
    return $role;
  }
  // End of viewRole 

  public static function role(DistriXStyRoleData $role): object
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewRole");
    $styServicesCaller->addParameter("data", $role);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Role/DistriXStyRoleViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRoleViewDataSvc");
      $logInfoData->setLogFunction("role");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewRole"])) {
        $return = $output["ViewRole"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listRole

  public static function saveRole(DistriXStyRoleData $data): array
  {
    $outputok          = false;
    $confirmSaveRole   = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveRole");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Role/DistriXStyRoleSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRoleSaveDataSvc");
      $logInfoData->setLogFunction("saveRole");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveRole  = $output['ConfirmSaveRole'];
    }
    return array($confirmSaveRole, $errorData);
  }
  // End of saveRole

  public static function delRole(DistriXStyRoleData $data): array
  {
    $outputok          = false;
    $confirmDelRole    = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelRole");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Role/DistriXStyRoleDelDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRoleDelDataSvc");
      $logInfoData->setLogFunction("delRole");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelRole  = true;
    }
    return array($confirmDelRole, $errorData);
  }
  // End of delRole

  public static function restoreRole(DistriXStyRoleData $data): array
  {
    $outputok          = false;
    $confirmRestoreRole= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("RestoreRole");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Role/DistriXStyRoleRestoreDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRoleRestoreDataSvc");
      $logInfoData->setLogFunction("restoreRole");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmRestoreRole  = true;
    }
    return array($confirmRestoreRole, $errorData);
  }
  // End of restoreRole
}

<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyUserTypeData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");

// ------------------------------------
// -----------L O G G E R ---------------
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

class DistriXStyAppUserType
{
  public static function listUserTypes(): array
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ListUserTypes");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/UserType/DistriXStyUserTypeListDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserTypeListDataSvc");
      $logInfoData->setLogFunction("listUserTypes");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ListUserTypes"])) {
        $return = $output["ListUserTypes"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listUserType

  public static function viewUserType($id = "")
  {
    $userType  = new DistriXStyUserTypeData();
    if ($id > 0) {
      $userType->setId($id);
      $userType = self::userType($userType);
    }
    return $userType;
  }
  // End of viewUserType 

  public static function userType(DistriXStyUserTypeData $userType): object
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewUserType");
    $styServicesCaller->addParameter("data", $userType);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/UserType/DistriXStyUserTypeViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserTypeViewDataSvc");
      $logInfoData->setLogFunction("userType");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewUserType"])) {
        $return = $output["ViewUserType"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listUserType

  public static function saveUserType(DistriXStyUserTypeData $data): array
  {
    $outputok          = false;
    $confirmSaveUserType   = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveUserType");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/UserType/DistriXStyUserTypeSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserTypeSaveDataSvc");
      $logInfoData->setLogFunction("saveUserType");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveUserType  = $output['ConfirmSaveUserType'];
    }
    return array($confirmSaveUserType, $errorData);
  }
  // End of saveUserType

  public static function delUserType(DistriXStyUserTypeData $data): array
  {
    $outputok          = false;
    $confirmDelUserType    = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelUserType");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/UserType/DistriXStyUserTypeDelDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserTypeDelDataSvc");
      $logInfoData->setLogFunction("delUserType");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelUserType  = true;
    }
    return array($confirmDelUserType, $errorData);
  }
  // End of delUserType

  public static function restoreUserType(DistriXStyUserTypeData $data): array
  {
    $outputok          = false;
    $confirmRestoreUserType= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("RestoreUserType");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/UserType/DistriXStyUserTypeRestoreDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserTypeRestoreDataSvc");
      $logInfoData->setLogFunction("restoreUserType");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmRestoreUserType  = true;
    }
    return array($confirmRestoreUserType, $errorData);
  }
  // End of restoreUserType
}

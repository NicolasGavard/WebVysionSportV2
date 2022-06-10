<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyRoleRightData.php");
include(__DIR__ . "/../Data/DistriXStyRoleRightsData.php");
include(__DIR__ . "/../Data/DistriXStyRoleRightData.php");
include(__DIR__ . "/../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../Data/DistriXStyModuleData.php");
include(__DIR__ . "/../Data/DistriXStyFunctionalityData.php");
include(__DIR__ . "/../Data/DistriXStyRightData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../DistriXCrypto/DistriXCrypto.php");
// DistriX LOGGER
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/Data/DistriXLoggerInfoData.php");

class DistriXStyAppRoleRight
{
  public static function listRoleRight(): array
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewRoleRight");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/RoleRight/DistriXStyRoleRightViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRoleRightViewDataSvc");
      $logInfoData->setLogFunction("listRoleRight");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ListRoleRight"])) {
        $return = $output["ListRoleRight"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of roleRight
  
  public static function roleRightByRole(DistriXStyRoleRightData $data): object
  {
    $outputok          = false;
    $output            = array();
    $return            = new DistriXStyRoleRightData();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewRoleRight");
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/RoleRight/DistriXStyRoleRightListDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRoleRightViewDataSvc");
      $logInfoData->setLogFunction("roleRightByRole");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewRoleRights"])) {
        $return = $output["ViewRoleRights"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of roleRight

  public static function saveRoleRight(DistriXStyRoleRightData $data): array
  {   
    $outputok           = false;
    $confirmSaveRoleRight= false;
    $output             = array();
    $styServicesCaller  = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveRoleRight");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/RoleRight/DistriXStyRoleRightSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRoleRightSaveDataSvc");
      $logInfoData->setLogFunction("saveRoleRight");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveRoleRight  = $output['ConfirmSaveRoleRight'];
    }
    return array($confirmSaveRoleRight, $errorData);
  }
  // End of saveRoleRight
  
  public static function delRoleRight(DistriXStyRoleRightData $data): array
  {
    $outputok          = false;
    $confirmDelRoleRight= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelRoleRight");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Role/DistriXStyRoleRightDeleteDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRoleRightDeleteDataSvc");
      $logInfoData->setLogFunction("DelRoleRight");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelRoleRight  = $output['ConfirmSaveRoleRight'];
    }
    return array($confirmDelRoleRight, $errorData);
  }
  // End of delRoleRight
}

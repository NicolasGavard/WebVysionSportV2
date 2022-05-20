<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyModuleData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");

// ------------------------------------
// -----------L O G G E R ---------------
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

class DistriXStyModule
{
  public static function listModules($idStyApplication = "")
  {
    $listApplicationModules  = array();
    $data       = new DistriXStyModuleData();
    if ($idStyApplication > 0) {
      $data->setIdStyApplication($idStyApplication);
    }
    $listApplicationModules = self::listApplicationModules($data);
    return $listApplicationModules;
  }
  // End of listModules 

  public static function listApplicationModules(DistriXStyModuleData $data): array
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Module/DistriXStyModuleListDataSvc.php");
    $styServicesCaller->setMethodName("ListModules");
    $styServicesCaller->addParameter("data", $data);
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyModuleListDataSvc");
      $logInfoData->setLogFunction("listApplicationModules");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ListModules"])) {
        $return = $output["ListModules"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listModule

  public static function viewModule($id = "")
  {
    $module  = new DistriXStyModuleData();
    if ($id > 0) {
      $module->setId($id);
      $module = self::module($module);
    }
    return $module;
  }
  // End of viewModule 

  public static function module(DistriXStyModuleData $module): object
  {
    $outputok          = false;
    $output            = array();
    $return            = new DistriXStyModuleData();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewModule");
    $styServicesCaller->addParameter("data", $module);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Module/DistriXStyModuleViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyModuleViewDataSvc");
      $logInfoData->setLogFunction("module");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewModule"])) {
        $return = $output["ViewModule"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listModule

  public static function saveModule(DistriXStyModuleData $data): array
  {
    $outputok          = false;
    $confirmSaveModule   = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveModule");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Module/DistriXStyModuleSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyModuleSaveDataSvc");
      $logInfoData->setLogFunction("saveModule");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveModule  = $output['ConfirmSaveModule'];
    }
    return array($confirmSaveModule, $errorData);
  }
  // End of saveModule

  public static function delModule(DistriXStyModuleData $data): array
  {
    $outputok          = false;
    $confirmDelModule  = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelModule");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Module/DistriXStyModuleDeleteDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyModuleDeleteDataSvc");
      $logInfoData->setLogFunction("DelModule");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelModule  = $output['ConfirmSaveModule'];
    }
    return array($confirmDelModule, $errorData);
  }
  // End of delModule

  public static function restoreModule(DistriXStyModuleData $data): array
  {
    $outputok          = false;
    $confirmRestoreModule= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("RestoreModule");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Module/DistriXStyModuleRestoreDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyModuleRestoreDataSvc");
      $logInfoData->setLogFunction("restoreModule");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmRestoreModule  = $output['ConfirmSaveModule'];
    }
    return array($confirmRestoreModule, $errorData);
  }
  // End of restoreModule
}

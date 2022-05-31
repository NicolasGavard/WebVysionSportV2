<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyApplicationData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");

// ------------------------------------
// -----------L O G G E R ---------------
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

class DistriXStyAppApplication
{
  public static function listApplications(): array
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ListApplications");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Application/DistriXStyApplicationListDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Application")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyApplicationListDataSvc");
      $logInfoData->setLogFunction("listApplications");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ListApplications"])) {
        $return = $output["ListApplications"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listApplication

  public static function viewApplication($id = "")
  {
    $application  = new DistriXStyApplicationData();
    if ($id > 0) {
      $application->setId($id);
      $application = self::application($application);
    }
    return $application;
  }
  // End of viewApplication 

  public static function application(DistriXStyApplicationData $application): object
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewApplication");
    $styServicesCaller->addParameter("data", $application);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Application/DistriXStyApplicationViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Application")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyApplicationViewDataSvc");
      $logInfoData->setLogFunction("application");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewApplication"])) {
        $return = $output["ViewApplication"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listApplication

  public static function saveApplication(DistriXStyApplicationData $data): array
  {
    $outputok          = false;
    $confirmSaveApplication   = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveApplication");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Application/DistriXStyApplicationSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Application")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyApplicationSaveDataSvc");
      $logInfoData->setLogFunction("saveApplication");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveApplication  = true;
    }
    return array($confirmSaveApplication, $errorData);
  }
  // End of saveApplication

  public static function delApplication(DistriXStyApplicationData $data): array
  {
    $outputok          = false;
    $confirmDelApplication    = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelApplication");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Application/DistriXStyApplicationDeleteDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Application")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyApplicationDeleteDataSvc");
      $logInfoData->setLogFunction("delApplication");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelApplication  = $output['ConfirmSaveApplication'];
    }
    return array($confirmDelApplication, $errorData);
  }
  // End of delApplication

  public static function restoreApplication(DistriXStyApplicationData $data): array
  {
    $outputok          = false;
    $confirmRestoreApplication= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("RestoreApplication");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Application/DistriXStyApplicationRestoreDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    // Must manager $errorData. Yvan 23-Feb-22
    $logInfoData = new DistriXLoggerInfoData();
    $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
    $logInfoData->setLogApplication("DistriXStyAppInterface");
    $logInfoData->setLogFunction("restoreApplication");
    $logInfoData->setLogData(print_r($output, true));
    // DistriXLogger::log(__DIR__ . "/../DistriXLoggerSettings.php", $logInfoData);

    if ($outputok && !empty($output) > 0) {
      $confirmRestoreApplication  = $output['ConfirmSaveApplication'];
    }
    return array($confirmRestoreApplication, $errorData);
  }
  // End of restoreApplication
}

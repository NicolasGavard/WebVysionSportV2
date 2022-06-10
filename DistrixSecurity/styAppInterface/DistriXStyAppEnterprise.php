<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyEnterpriseData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");

// ------------------------------------
// -----------L O G G E R ---------------
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/Data/DistriXLoggerInfoData.php");

class DistriXStyAppEnterprise
{
  public static function listEnterprises(): array
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ListEnterprises");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Enterprise/DistriXStyEnterprisesListDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyEnterprisesListDataSvc");
      $logInfoData->setLogFunction("listEnterprises");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ListEnterprises"])) {
        $return = $output["ListEnterprises"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listEnterprises

  public static function viewEnterprise($id = "")
  {
    $enterprise  = new DistriXStyEnterpriseData();
    if ($id > 0) {
      $enterprise->setId($id);
      $enterprise = self::enterprise($enterprise);
    }
    return $enterprise;
  }
  // End of viewEnterprise 

  public static function enterprise(DistriXStyEnterpriseData $enterprise): object
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewEnterprise");
    $styServicesCaller->addParameter("data", $enterprise);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Enterprise/DistriXStyEnterpriseViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyEnterpriseViewDataSvc");
      $logInfoData->setLogFunction("enterprise");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewEnterprise"])) {
        $return = $output["ViewEnterprise"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listEnterprise

  public static function saveEnterprise(DistriXStyEnterpriseData $data): array
  {
    $outputok               = false;
    $confirmSaveEnterprise  = false;
    $idStyEnterprise       = 0;
    $output                 = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveEnterprise");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Enterprise/DistriXStyEnterpriseSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();    //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyEnterpriseSaveDataSvc");
      $logInfoData->setLogFunction("saveEnterprise");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveEnterprise  = $output["ConfirmSaveEnterprise"];
      $idStyEnterprise        = $output["idStyEnterprise"];
    }
    return array($confirmSaveEnterprise, $idStyEnterprise, $errorData);
  }
  // End of saveEnterprise

  public static function delEnterprise(DistriXStyEnterpriseData $data): array
  {
    $outputok          = false;
    $confirmDelEnterprise    = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelEnterprise");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Enterprise/DistriXStyEnterpriseDelDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyEnterpriseDelDataSvc");
      $logInfoData->setLogFunction("delEnterprise");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelEnterprise  = true;
    }
    return array($confirmDelEnterprise, $errorData);
  }
  // End of delEnterprise

  public static function restoreEnterprise(DistriXStyEnterpriseData $data): array
  {
    $outputok          = false;
    $confirmRestoreEnterprise= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("RestoreEnterprise");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Enterprise/DistriXStyEnterpriseRestoreDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyEnterpriseRestoreDataSvc");
      $logInfoData->setLogFunction("restoreEnterprise");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmRestoreEnterprise  = true;
    }
    return array($confirmRestoreEnterprise, $errorData);
  }
  // End of restoreEnterprise
}

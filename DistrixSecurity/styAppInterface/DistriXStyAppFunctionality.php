<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyFunctionalityData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");

// ------------------------------------
// -----------L O G G E R ---------------
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/Data/DistriXLoggerInfoData.php");

class DistriXStyAppFunctionality
{
  public static function listFunctionalities($idStyApplication = "", $idStyModule = "")
  {
    $listFunctionalitiesModules  = array();
    $data       = new DistriXStyFunctionalityData();
    if ($idStyApplication > 0) {
      $data->setIdStyApplication($idStyApplication);
    }
    if ($idStyModule > 0) {
      $data->setIdStyModule($idStyModule);
    }
    $listFunctionalitiesModules = self::listModuleFunctionalities($data);
    return $listFunctionalitiesModules;
  }
  // End of listModules
  
  public static function listModuleFunctionalities(DistriXStyFunctionalityData $data): array
  {
    $outputok          = false;
    $output            = array();
    $return            = new DistriXStyFunctionalityData();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Functionality/DistriXStyFunctionalityListDataSvc.php");
    $styServicesCaller->setMethodName("ListFunctionalities");
    $styServicesCaller->addParameter("data", $data);
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyFunctionalityListDataSvc");
      $logInfoData->setLogFunction("listModuleFunctionalities");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ListFunctionalities"])) {
        $return = $output["ListFunctionalities"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listFunctionality

  public static function viewFunctionality($id = "")
  {
    $functionality  = new DistriXStyFunctionalityData();
    if ($id > 0) {
      $functionality->setId($id);
      $functionality = self::functionality($functionality);
    }
    return $functionality;
  }
  // End of viewFunctionality 

  public static function functionality(DistriXStyFunctionalityData $functionality): object
  {
    $outputok          = false;
    $output            = array();
    $return            = new DistriXStyFunctionalityData();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewFunctionality");
    $styServicesCaller->addParameter("data", $functionality);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Functionality/DistriXStyFunctionalityViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyFunctionalityViewDataSvc");
      $logInfoData->setLogFunction("functionality");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewFunctionality"])) {
        $return = $output["ViewFunctionality"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listFunctionality

  public static function saveFunctionality(DistriXStyFunctionalityData $data): array
  {
    $outputok          = false;
    $confirmSaveFunctionality   = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveFunctionality");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Functionality/DistriXStyFunctionalitySaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyFunctionalitySaveDataSvc");
      $logInfoData->setLogFunction("saveFunctionality");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveFunctionality  = $output['ConfirmSaveFunctionality'];
    }
    return array($confirmSaveFunctionality, $errorData);
  }
  // End of saveFunctionality

  public static function delFunctionality(DistriXStyFunctionalityData $data): array
  {
    $outputok          = false;
    $confirmDelFunctionality    = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelFunctionality");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Functionality/DistriXStyFunctionalityDelDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyFunctionalityDelDataSvc");
      $logInfoData->setLogFunction("delFunctionality");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelFunctionality  = $output['ConfirmSaveFunctionality'];
    }
    return array($confirmDelFunctionality, $errorData);
  }
  // End of delFunctionality

  public static function restoreFunctionality(DistriXStyFunctionalityData $data): array
  {
    $outputok          = false;
    $confirmRestoreFunctionality= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("RestoreFunctionality");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Functionality/DistriXStyFunctionalityRestoreDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyFunctionalityRestoreDataSvc");
      $logInfoData->setLogFunction("restoreFunctionality");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmRestoreFunctionality  = $output['ConfirmSaveFunctionality'];
    }
    return array($confirmRestoreFunctionality, $errorData);
  }
  // End of restoreFunctionality
}

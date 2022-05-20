<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyUserRightData.php");
include(__DIR__ . "/../Data/DistriXStyUserRightsData.php");
include(__DIR__ . "/../Data/DistriXStyRoleRightData.php");
include(__DIR__ . "/../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../Data/DistriXStyModuleData.php");
include(__DIR__ . "/../Data/DistriXStyFunctionalityData.php");
include(__DIR__ . "/../Data/DistriXStyRightData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../DistrixCrypto/DistriXCrypto.php");
// DistriX LOGGER
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

class DistriXStyUserRight
{
  public static function viewUserRight($idStyUser = "", $idStyApplication = "", $idStyModule = "", $idStyFunctionality = "", $sumOfRights = "")
  {
    $userRight  = new DistriXStyUserRightData();
    if ($idStyUser > 0) {
      $userRight->setIdStyUser($idStyUser);
    }
    if ($idStyApplication > 0) {
      $userRight->setIdStyApplication($idStyApplication);
    }
    if ($idStyModule > 0) {
      $userRight->setIdStyModule($idStyModule);
    }
    if ($idStyFunctionality > 0) {
      $userRight->setIdStyFunctionality($idStyFunctionality);
    }
    if ($sumOfRights > 0) {
      $userRight->setSumOfRights($sumOfRights);
    }
    $userRight = self::userRight($userRight);
    return $userRight;
  }
  // End of viewUserRight 

  public static function userRight(DistriXStyUserRightData $userRight): object
  {
    $outputok          = false;
    $output            = array();
    $return            = new DistriXStyUserRightsData();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewUserRight");
    $styServicesCaller->addParameter("data", $userRight);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/UserRight/DistriXStyUserRightViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserRightViewDataSvc");
      $logInfoData->setLogFunction("ViewUserRight");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewUserRights"])) {
        $return = $output["ViewUserRights"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of userRight

  public static function saveUserRight(DistriXStyUserRightData $data): array
  {
    $outputok           = false;
    $confirmSaveUserRight= false;
    $output             = array();
    $styServicesCaller  = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveUserRight");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyUserRightSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserRightSaveDataSvc");
      $logInfoData->setLogFunction("saveUserRight");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveUserRight  = $output['ConfirmSaveUserRight'];
    }
    return array($confirmSaveUserRight, $errorData);
  }
  // End of saveUserRight
  
  public static function delUserRight(DistriXStyUserRightData $data): array
  {
    $outputok          = false;
    $confirmDelUserRight= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelUserRight");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyUserRightDeleteDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyUserRightDeleteDataSvc");
      $logInfoData->setLogFunction("delUserRight");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelUserRight  = $output['ConfirmSaveUserRight'];
    }
    return array($confirmDelUserRight, $errorData);
  }
  // End of delUserRight
}

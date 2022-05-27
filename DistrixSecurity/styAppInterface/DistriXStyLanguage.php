<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyLanguageData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../DistrixCrypto/DistriXCrypto.php");
// DistriX LOGGER
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

class DistriXStyLanguage
{
  public static function listLanguages(): array
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ListLanguages");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Language/DistriXStyLanguageListDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security_Language")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyLanguageListDataSvc");
      $logInfoData->setLogFunction("listLanguages");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ListLanguages"])) {
        $return = $output["ListLanguages"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listLanguage
  
  public static function viewLanguage($idStyLanguage = "")
  {
    $language  = new DistriXStyLanguageData();
    if ($idStyLanguage > 0) {
      $language->setId($idStyLanguage);
    }
    $language = self::language($language);
    return $language;
  }
  // End of viewLanguage 

  public static function language(DistriXStyLanguageData $language): object
  {
    $outputok          = false;
    $output            = array();
    $return            = new DistriXStyLanguageData();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewLanguage");
    $styServicesCaller->addParameter("data", $language);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Language/DistriXStyLanguageViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyLanguageViewDataSvc");
      $logInfoData->setLogFunction("ViewLanguage");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewLanguage"])) {
        $return = $output["ViewLanguage"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of language

  public static function saveLanguage(DistriXStyLanguageData $data): array
  {
    $outputok           = false;
    $confirmSaveLanguage= false;
    $output             = array();
    $styServicesCaller  = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveLanguage");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Language/DistriXStyLanguageSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyLanguageSaveDataSvc");
      $logInfoData->setLogFunction("saveLanguage");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveLanguage  = $output['ConfirmSaveLanguage'];
    }
    return array($confirmSaveLanguage, $errorData);
  }
  // End of saveLanguage
  
  public static function delLanguage(DistriXStyLanguageData $data): array
  {
    $outputok          = false;
    $confirmDelLanguage= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelLanguage");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Language/DistriXStyLanguageDeleteDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyLanguageDeleteDataSvc");
      $logInfoData->setLogFunction("delLanguage");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelLanguage  = $output['ConfirmSaveLanguage'];
    }
    return array($confirmDelLanguage, $errorData);
  }
  // End of delLanguage
  
  public static function restoreLanguage(DistriXStyLanguageData $data): array
  {
    $outputok          = false;
    $confirmDelLanguage= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("RestoreLanguage");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Language/DistriXStyLanguageRestoreDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //print_r($output);
    
    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyLanguageRestoreDataSvc");
      $logInfoData->setLogFunction("restoreLanguage");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelLanguage  = $output['ConfirmSaveLanguage'];
    }
    return array($confirmDelLanguage, $errorData);
  }
  // End of restoreLanguage
}

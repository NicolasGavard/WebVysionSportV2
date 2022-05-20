<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyRightData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");

// ------------------------------------
// -----------L O G G E R ---------------
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

class DistriXStyRight
{
  public static function listRights(): array
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ListRights");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Right/DistriXStyRightListDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRightListDataSvc");
      $logInfoData->setLogFunction("listRights");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ListRights"])) {
        $return = $output["ListRights"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listRight

  public static function viewRight($id = "")
  {
    $right  = new DistriXStyRightData();
    if ($id > 0) {
      $right->setId($id);
      $right = self::right($right);
    }
    return $right;
  }
  // End of viewRight 

  public static function right(DistriXStyRightData $right): object
  {
    $outputok          = false;
    $output            = array();
    $return            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->setMethodName("ViewRight");
    $styServicesCaller->addParameter("data", $right);
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Right/DistriXStyRightViewDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call(); //var_dump($output);

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRightViewDataSvc");
      $logInfoData->setLogFunction("right");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      if (isset($output["ViewRight"])) {
        $return = $output["ViewRight"];
      }
    } else {
      $return = $errorData;
    }
    return $return;
  }
  // End of listRight

  public static function saveRight(DistriXStyRightData $data): array
  {
    $outputok          = false;
    $confirmSaveRight   = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveRight");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Right/DistriXStyRightSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRightSaveDataSvc");
      $logInfoData->setLogFunction("saveRight");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmSaveRight  = true;
    }
    return array($confirmSaveRight, $errorData);
  }
  // End of saveRight

  public static function delRight(DistriXStyRightData $data): array
  {
    $outputok          = false;
    $confirmDelRight    = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("DelRight");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Right/DistriXStyRightDelDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRightDelDataSvc");
      $logInfoData->setLogFunction("delRight");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmDelRight  = true;
    }
    return array($confirmDelRight, $errorData);
  }
  // End of delRight

  public static function restoreRight(DistriXStyRightData $data): array
  {
    $outputok          = false;
    $confirmRestoreRight= false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("RestoreRight");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/Right/DistriXStyRightRestoreDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", "Security")) {
      $logInfoData = new DistriXLoggerInfoData();
      $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
      $logInfoData->setLogApplication("DistriXStyRightRestoreDataSvc");
      $logInfoData->setLogFunction("restoreRight");
      $logInfoData->setLogData(print_r($output, true));
      DistriXLogger::log($logInfoData);
    }

    if ($outputok && !empty($output) > 0) {
      $confirmRestoreRight  = true;
    }
    return array($confirmRestoreRight, $errorData);
  }
  // End of restoreRight
  
  public static function isRightConnected(string $application, string $module, string $functionality): bool
  {
    $isRightConnected = false;
    if (isset($_SESSION["DistriXSvcSecurity"]["StyUser"])) {
      $userData  = unserialize($_SESSION["DistriXSvcSecurity"]["StyUser"]);
      $isRightConnected = ($userData->getConnected());
    }
    if ($isRightConnected) {
      $isRightConnected = self::hasAnyRightInternal($application, $module, $functionality);
    }
    return $isRightConnected;
  }
  public static function hasRightConnected(int $right, string $application, string $module, string $functionality): bool
  {
    $hasRightConnected = false;
    if (isset($_SESSION["DistriXSvcSecurity"]["StyUser"])) {
      $userData  = unserialize($_SESSION["DistriXSvcSecurity"]["StyUser"]);
      $hasRightConnected = ($userData->getConnected());
    }
    if ($hasRightConnected) {
      $hasRightConnected = self::hasRightInternal($right, $application, $module, $functionality);
    }
    return $hasRightConnected;
  }

  private static function hasRightInternal(int $right, string $app, string $module, string $functionality): bool
  {
    $hasRight = false;
    if ($right > 0 && $app != "" && isset($_SESSION["DistriXSvcSecurity"]["StyUserRights"])) {
      $userRights = unserialize($_SESSION["DistriXSvcSecurity"]["StyUserRights"]);
      $userRightsInd = 0;
      if (!empty($userRights)) {
        $userRightsInd = count($userRights);
      }
      for ($indR = 0; $indR < $userRightsInd && !$hasRight; $indR++) {
        $dataRight = $userRights[$indR];
        if (
          $dataRight->getApplicationCode() == $app &&
          ($dataRight->getModuleCode() == $module || $module == "") &&
          ($dataRight->getFunctionalityCode() == $functionality || $functionality == "")
        ) {
          $calc = $dataRight->getSumOfRights();
          //echo "#hasRight#@calc#$calc<br/>";
          //echo "#hasRight#@right recherche#$right<br/>";

          $hasRight = ($calc >= $right || $calc == STY_RIGHT_MANAGE);
          // les droits sont-ils assez élevés pour le droit recheché  or Full Power User ?
          if ($hasRight && $calc != STY_RIGHT_MANAGE) {
            $calc -= $right;
            //echo "hasRight#@calc - right #$calc<br/>";
            if ($calc == 0) {
              $hasRight = true; // Seulement un droit et celui recherché
            } else {
              $i = STY_RIGHT_MAX;
              while ($i >= STY_RIGHT_MIN) {
                if ($calc >= $i && $i != $right) { // Droit mixé avec d'autres droits ?
                  $calc -= $i;
                  //echo "hasRight#@type right#$i<br/>";
                  //echo "hasRight#@calc #$calc<br/>";
                }
                $i = $i / 2;
              }
            }
            $hasRight = ($calc == 0);
            //$hasRight = ($calc == 0)?1:0;
          }
        }
      }
    }
    return $hasRight;
  }
  // End of hasRight

  private static function hasAnyRightInternal(string $app, string $module, string $functionality): bool
  {
    $hasAnyRight = false;
    if ($app != "" && isset($_SESSION["DistriXSvcSecurity"]["StyUserRights"])) {
      $userRights = unserialize($_SESSION["DistriXSvcSecurity"]["StyUserRights"]);
      $userRightsInd = 0;
      if (!empty($userRights)) {
        $userRightsInd = count($userRights);
      }
      for ($indR = 0; $indR < $userRightsInd && !$hasAnyRight; $indR++) {
        $dataRight = $userRights[$indR];
        if (
          $dataRight->getApplicationCode() == $app &&
          ($dataRight->getModuleCode() == $module || $module == "") &&
          ($dataRight->getFunctionalityCode() == $functionality || $functionality == "")
        ) {
          $hasAnyRight = true;
        }
      }
    }
    return $hasAnyRight;
  }
  // End of hasAnyRight
}

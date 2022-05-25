<?php // Needed to encode in UTF8 ààéàé //
// Data
include(__DIR__ . "/../Data/DistriXStyEnterprise.php");
// Layer
include(__DIR__ . "/../Layers/DistriXStySvcCaller.php");

// ------------------------------------
// -----------L O G G E R ---------------
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

class DistriXStyEnterprise
{
  
  public static function saveUser(DistriXStyInfoSessionData $data): array
  {
    $outputok          = false;
    $output            = array();
    $styServicesCaller = new DistriXStySvcCaller();
    $styServicesCaller->addParameter("data", $data);
    $styServicesCaller->setMethodName("SaveUser");
    $styServicesCaller->setServiceName("DistriXSecurity/StyServices/User/DistriXStyProfilSaveDataSvc.php");
    list($outputok, $output, $errorData) = $styServicesCaller->call();

    // Must manager $errorData. Yvan 23-Feb-22
    $logInfoData = new DistriXLoggerInfoData();
    $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
    $logInfoData->setLogApplication("DistriXStyAppInterface");
    $logInfoData->setLogFunction("saveUser");
    $logInfoData->setLogData(print_r($output, true));
    // DistriXLogger::log(__DIR__ . "/../DistriXLoggerSettings.php", $logInfoData);

    if ($outputok && !empty($output) > 0) {
      $_SESSION["DistriXSvcSecurity"]["StyUser"]            = serialize($output["StyInfoSession"]);
      $_SESSION["DistriXSvcSecurity"]["StyUserRoles"]       = serialize($output["StyUserRoles"]);
      $_SESSION["DistriXSvcSecurity"]["StyUserRights"]      = serialize($output["StyUserRights"]);
      $_SESSION["DistriXSvcSecurity"]["StyUserEnterprises"] = serialize($output["StyUserEnterprises"]);
      $_SESSION["DistriXSvcSecurity"]["StyEnterprises"]     = serialize($output["StyEnterprises"]);
      $_SESSION["DistriXSvcSecurity"]["StyEnterprisePos"]   = serialize($output["StyEnterprisePos"]);
    }

    $confirmSaveUser  = false;

    $outputok      = false;
    $output        = array();
    $layerData     = new DjangoSvcLayerData();
    $clientSvcCall = new DjangoSvcCallerSty();
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Users/StyUsersDataSvc.php");
    $clientSvcCall->setMethodName("SaveUser");
    $clientSvcCall->addParameter("djangoSty", $djangoSty);    //print_r($djangoSty);
    $clientSvcCall->addParameter("data", $data);              //print_r($data);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call();        //echo " STY Save User : ".print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["ConfirmSaveUser"])) {
        $confirmSaveUser = $output["ConfirmSaveUser"];
        $appErrorSvcData = $output["Error"];
      }
    }
    return array($confirmSaveUser, $appErrorSvcData);
  }
  // End of saveUser

  public static function delUser($application, $data)
  {
    $djangoSty = new DjangoStyInitPassData();
    $djangoSty->setApplication($application);

    $confirmDelUser = false;
    $outputok       = false;
    $output         = array();
    $layerData      = new DjangoSvcLayerData();
    $clientSvcCall  = new DjangoSvcCallerSty();
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Users/StyUsersDataSvc.php");
    $clientSvcCall->setMethodName("DelUser");
    $clientSvcCall->addParameter("djangoSty", $djangoSty);
    print_r($djangoSty);
    $clientSvcCall->addParameter("data", $data);
    print_r($data);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call();
    echo " STY Delete User : " . print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["ConfirmDelUser"])) $confirmDelUser = $output["ConfirmDelUser"];
    }
    return $confirmDelUser;
  }
  // End of delUser

  public static function restoreUser($application, $data)
  {
    $djangoSty = new DjangoStyInitPassData();
    $djangoSty->setApplication($application);

    $outputok           = false;
    $output             = array();
    $layerData          = new DjangoSvcLayerData();
    $clientSvcCall      = new DjangoSvcCallerSty();
    $confirmRestoreUser = false;
    $clientSvcCall->setServiceName(DJANGOSTY_TWO_LEVEL_UP . "styServices/Users/StyUsersDataSvc.php");
    $clientSvcCall->setMethodName("RestoreUser");
    $clientSvcCall->addParameter("djangoSty", $djangoSty);
    $clientSvcCall->addParameter("data", $data);
    $clientSvcCall->setLayerData($layerData);
    list($outputok, $output) = $clientSvcCall->call(); //echo " STY Restore User : ".print_r($output);
    if ($outputok && !empty($output) > 0) {
      if (isset($output["ConfirmRestoreUser"])) $confirmRestoreUser = $output["ConfirmRestoreUser"];
    }
    return $confirmRestoreUser;
  }
  // End of restoreUser
}

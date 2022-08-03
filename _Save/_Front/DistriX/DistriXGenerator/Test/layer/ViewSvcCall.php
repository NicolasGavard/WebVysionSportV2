<?php // Needed to encode in UTF8 ààéàé //
//
// Version : 1-10
//

include("layer/BaseSvcCall.php");

if (! class_exists('ViewSvcCall', false)) {
class ViewSvcCall extends BaseSvcCall
{
/* View Servers Addresses Values */
const VIEW_SRV_DEV = "127.0.0.1";
const VIEW_SRV_TEST = "192.168.1.86";
const VIEW_SRV_PROD = "192.168.255.255";
const VIEW_SRV_CALL = self::VIEW_SRV_DEV;

/* View Servers Kind of Call Values */
const VIEW_CALL_DEV = "http";
const VIEW_CALL_TEST = "https";
const VIEW_CALL_PROD = "https";
const VIEW_CALL_CALL = self::VIEW_CALL_DEV;

/* View Servers Directories Values */
const VIEW_DIR_DEV = "CodeGenerator/Test";
const VIEW_DIR_TEST = "ViewServices";
const VIEW_DIR_PROD = "ViewServices";
const VIEW_DIR_CALL = self::VIEW_DIR_DEV;

public function __construct()
{
  $this->setServerAddress(self::VIEW_SRV_CALL);
  $this->setServerCall(self::VIEW_CALL_CALL);
  $this->setServerDirectory(self::VIEW_DIR_CALL);
}

// Get's
public function getViewServerDev() { return self::VIEW_SRV_DEV; }
public function getViewServerTest() { return self::VIEW_SRV_TEST; }
public function getViewServerProd() { return self::VIEW_SRV_PROD; }
public function getViewServerCall() { return self::VIEW_SRV_CALL; }
public function isViewServerDev() { return (self::VIEW_SRV_CALL == self::VIEW_SRV_DEV); }
public function isViewServerTest() { return (self::VIEW_SRV_CALL == self::VIEW_SRV_TEST); }
public function isViewServerProd() { return (self::VIEW_SRV_CALL == self::VIEW_SRV_PROD); }

public function getViewCallDev() { return self::VIEW_CALL_DEV; }
public function getViewCallTest() { return self::VIEW_CALL_TEST; }
public function getViewCallProd() { return self::VIEW_CALL_PROD; }
public function getViewCallCall() { return self::VIEW_CALL_CALL; }
public function isViewCallDev() { return (self::VIEW_CALL_CALL == self::VIEW_CALL_DEV); }
public function isViewCallTest() { return (self::VIEW_CALL_CALL == self::VIEW_CALL_TEST); }
public function isViewCallProd() { return (self::VIEW_CALL_CALL == self::VIEW_CALL_PROD); }

public function getViewDirDev() { return self::VIEW_DIR_DEV; }
public function getViewDirTest() { return self::VIEW_DIR_TEST; }
public function getViewDirProd() { return self::VIEW_DIR_PROD; }
public function getViewDirCall() { return self::VIEW_DIR_CALL; }
public function isViewDirDev() { return (self::VIEW_DIR_CALL == self::VIEW_DIR_DEV); }
public function isViewDirTest() { return (self::VIEW_DIR_CALL == self::VIEW_DIR_TEST); }
public function isViewDirProd() { return (self::VIEW_DIR_CALL == self::VIEW_DIR_PROD); }

}
// End of Class
}
// class_exists
?>
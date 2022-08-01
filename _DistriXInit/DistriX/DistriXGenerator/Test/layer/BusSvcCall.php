<?php // Needed to encode in UTF8 ààéàé //
//
// Data Version : 1-10
//

include("layer/BaseSvcCall.php");

if (! class_exists('BusSvcCall', false)) {
class BusSvcCall extends BaseSvcCall
{
/* Business Servers Addresses Values */
const BUS_SRV_DEV = "127.0.0.1";
const BUS_SRV_TEST = "192.168.1.86";
const BUS_SRV_PROD = "192.168.255.255";
const BUS_SRV_CALL = self::BUS_SRV_DEV;

/* Business Servers Kind of Call Values */
const BUS_CALL_DEV = "http";
const BUS_CALL_TEST = "https";
const BUS_CALL_PROD = "https";
const BUS_CALL_CALL = self::BUS_CALL_DEV;

/* Business Servers Directories Values */
const BUS_DIR_DEV = "CodeGenerator/Test";
const BUS_DIR_TEST = "BusServices";
const BUS_DIR_PROD = "BusServices";
const BUS_DIR_CALL = self::BUS_DIR_DEV;

public function __construct()
{
  $this->setServerAddress(self::BUS_SRV_CALL);
  $this->setServerCall(self::BUS_CALL_CALL);
  $this->setServerDirectory(self::BUS_DIR_CALL);
}

// Get's
public function getBusServerDev() { return self::BUS_SRV_DEV; }
public function getBusServerTest() { return self::BUS_SRV_TEST; }
public function getBusServerProd() { return self::BUS_SRV_PROD; }
public function getBusServerCall() { return self::BUS_SRV_CALL; }
public function isBusServerDev() { return (self::BUS_SRV_CALL == self::BUS_SRV_DEV); }
public function isBusServerTest() { return (self::BUS_SRV_CALL == self::BUS_SRV_TEST); }
public function isBusServerProd() { return (self::BUS_SRV_CALL == self::BUS_SRV_PROD); }

public function getBusCallDev() { return self::BUS_CALL_DEV; }
public function getBusCallTest() { return self::BUS_CALL_TEST; }
public function getBusCallProd() { return self::BUS_CALL_PROD; }
public function getBusCallCall() { return self::BUS_CALL_CALL; }
public function isBusCallDev() { return (self::BUS_CALL_CALL == self::BUS_CALL_DEV); }
public function isBusCallTest() { return (self::BUS_CALL_CALL == self::BUS_CALL_TEST); }
public function isBusCallProd() { return (self::BUS_CALL_CALL == self::BUS_CALL_PROD); }

public function getBusDirDev() { return self::BUS_DIR_DEV; }
public function getBusDirTest() { return self::BUS_DIR_TEST; }
public function getBusDirProd() { return self::BUS_DIR_PROD; }
public function getBusDirCall() { return self::BUS_DIR_CALL; }
public function isBusDirDev() { return (self::BUS_DIR_CALL == self::BUS_DIR_DEV); }
public function isBusDirTest() { return (self::BUS_DIR_CALL == self::BUS_DIR_TEST); }
public function isBusDirProd() { return (self::BUS_DIR_CALL == self::BUS_DIR_PROD); }

}
// End of Class
}
// class_exists
?>
<?php // Needed to encode in UTF8 ààéàé //
//
// Data Version : 1-10
//

include("Svc/BaseSvcCall.php");

if (! class_exists('DataSvcCall', false)) {
class DataSvcCall extends BaseSvcCall
{
/* Data Servers Addresses Values */
const DATA_SRV_DEV = "127.0.0.1";
const DATA_SRV_TEST = "192.168.1.86";
const DATA_SRV_PROD = "192.168.255.255";
const DATA_SRV_CALL = self::DATA_SRV_DEV;

/* Data Servers Kind of Call Values */
const DATA_CALL_DEV = "http";
const DATA_CALL_TEST = "https";
const DATA_CALL_PROD = "https";
const DATA_CALL_CALL = self::DATA_CALL_DEV;

/* Data Servers Directories Values */
const DATA_DIR_DEV = "CodeGenerator/Test";
const DATA_DIR_TEST = "DataServices";
const DATA_DIR_PROD = "DataServices";
const DATA_DIR_CALL = self::DATA_DIR_DEV;

public function __construct()
{
  $this->setServerAddress(self::DATA_SRV_CALL);
  $this->setServerCall(self::DATA_CALL_CALL);
  $this->setServerDirectory(self::DATA_DIR_CALL);
}

// Get's
public function getDataServerDev() { return self::DATA_SRV_DEV; }
public function getDataServerTest() { return self::DATA_SRV_TEST; }
public function getDataServerProd() { return self::DATA_SRV_PROD; }
public function getDataServerCall() { return self::DATA_SRV_CALL; }
public function isDataServerDev() { return (self::DATA_SRV_CALL == self::DATA_SRV_DEV); }
public function isDataServerTest() { return (self::DATA_SRV_CALL == self::DATA_SRV_TEST); }
public function isDataServerProd() { return (self::DATA_SRV_CALL == self::DATA_SRV_PROD); }

public function getDataCallDev() { return self::DATA_CALL_DEV; }
public function getDataCallTest() { return self::DATA_CALL_TEST; }
public function getDataCallProd() { return self::DATA_CALL_PROD; }
public function getDataCallCall() { return self::DATA_CALL_CALL; }
public function isDataCallDev() { return (self::DATA_CALL_CALL == self::DATA_CALL_DEV); }
public function isDataCallTest() { return (self::DATA_CALL_CALL == self::DATA_CALL_TEST); }
public function isDataCallProd() { return (self::DATA_CALL_CALL == self::DATA_CALL_PROD); }

public function getDataDirDev() { return self::DATA_DIR_DEV; }
public function getDataDirTest() { return self::DATA_DIR_TEST; }
public function getDataDirProd() { return self::DATA_DIR_PROD; }
public function getDataDirCall() { return self::DATA_DIR_CALL; }
public function isDataDirDev() { return (self::DATA_DIR_CALL == self::DATA_DIR_DEV); }
public function isDataDirTest() { return (self::DATA_DIR_CALL == self::DATA_DIR_TEST); }
public function isDataDirProd() { return (self::DATA_DIR_CALL == self::DATA_DIR_PROD); }

}
// End of Class
}
// class_exists

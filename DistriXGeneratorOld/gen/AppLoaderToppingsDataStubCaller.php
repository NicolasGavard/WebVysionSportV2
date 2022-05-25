<?php // Needed to encode in UTF8 ààéàé //
include("EkimCallerSvcBase.php");
if (! class_exists("AppLoaderToppingsDataStubCaller", false)) {
  class AppLoaderToppingsDataStubCaller extends EkimCallerSvcBase {
    const CLIENT_SRV_CALL  = "127.0.0.1";
    const CLIENT_CALL_CALL = "http";
    const CLIENT_DIR_CALL  = "AppLoaderServices";
    public function __construct() {
      $this->setServerAddress(self::CLIENT_SRV_CALL);
      $this->setServerCall(self::CLIENT_CALL_CALL);
      $this->setServerDirectory(self::CLIENT_DIR_CALL);
    }
    public function call() { 
      list($outputok, $output, $error) = parent::call();
      //print_r($output);
      if (is_string($output)) $output = @unserialize($output);
      return array($outputok, $output, $error);
    }
  }
  // End of Class
}
// class_exists
?>

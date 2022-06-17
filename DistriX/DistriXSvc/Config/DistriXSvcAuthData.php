<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXSvcAuthData", false)) {
  define("DISTRIX_SVC_AUTH_DATA_IP_ADDRESS", "DISTRIX_SVC_IpAddress");
  define("DISTRIX_SVC_AUTH_DATA_HOST",       "DISTRIX_SVC_Host");
  define("DISTRIX_SVC_AUTH_DATA_SECRET_KEY", "DISTRIX_SVC_SecretKey");

  class DistriXSvcAuthData
  {
    static private $authorizedHosts = array(
      "host1"  => array(
        DISTRIX_SVC_AUTH_DATA_IP_ADDRESS => "127.0.0.1",
        DISTRIX_SVC_AUTH_DATA_HOST => "EKIM-6",
        DISTRIX_SVC_AUTH_DATA_SECRET_KEY => "HelloAuthInDistriXSvc"
      ),
      "host2"  => array(
        DISTRIX_SVC_AUTH_DATA_IP_ADDRESS => "*",
        DISTRIX_SVC_AUTH_DATA_HOST => "*",
        DISTRIX_SVC_AUTH_DATA_SECRET_KEY => "*"
      )
    );

    // Gets
    public static function getIpAddresses(): array
    {
      $ipAddresses = [];
      foreach (self::$authorizedHosts as $authorizedHost) {
        $ipAddresses[] = $authorizedHost[DISTRIX_SVC_AUTH_DATA_IP_ADDRESS];
      }
      return $ipAddresses;
    }

    public static function getHosts(): array
    {
      $hosts = [];
      foreach (self::$authorizedHosts as $authorizedHost) {
        $hosts[] = $authorizedHost[DISTRIX_SVC_AUTH_DATA_HOST];
      }
      return $hosts;
    }

    public static function getSecretKeys(): array
    {
      $secretKeys = [];
      foreach (self::$authorizedHosts as $authorizedHost) {
        $secretKeys[] = $authorizedHost[DISTRIX_SVC_AUTH_DATA_SECRET_KEY];
      }
      return $secretKeys;
    }
  }
  // class_exists
}

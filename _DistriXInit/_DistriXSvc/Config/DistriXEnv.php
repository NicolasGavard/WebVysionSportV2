<?php
if (!defined('DISTRIX_ENV_DEV')) {
  define('DISTRIX_ENV_DEV', "DEV");
}
if (!defined('DISTRIX_ENV_INT')) {
  define('DISTRIX_ENV_INT', "INT");
}
if (!defined('DISTRIX_ENV_VER')) {
  define('DISTRIX_ENV_VER', "VER");
}
if (!defined('DISTRIX_ENV_VAL')) {
  define('DISTRIX_ENV_VAL', "VAL");
}
if (!defined('DISTRIX_ENV_PROD')) {
  define('DISTRIX_ENV_PROD', "PROD");
}
if (!defined('DISTRIX_ENV')) {
  define('DISTRIX_ENV', DISTRIX_ENV_DEV);
}
if (!defined('DISTRIX_UNAVAILABLE_SERVER')) {
  define('DISTRIX_UNAVAILABLE_SERVER', "127.0.0.1");
}
// By default
// $PHP_D_UNAVAILABLE_SERVER[] = "";
$DISTRIX_UNAVAILABLE_SERVER[] = "127.0.0.1";
// echo "<br/>PHP_D_UNAVAILABLE_SERVER in init: " . print_r($PHP_D_UNAVAILABLE_SERVER)."<br/>";
// $PHP_D_UNAVAILABLE_SERVER[] = "www.unavailableserver.com";

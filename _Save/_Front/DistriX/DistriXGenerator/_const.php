<?php // Needed to encode in UTF8 ààéàé //

define("DEV_SRV", '127.0.');
define("TST_SRV", "MikeTest");
define("TST_DIR", "MKTApr");

/* VERSION VALUE */
$version = "1.1";
  // Set to new version if local host
if (strpos($_SERVER['SERVER_NAME'], DEV_SRV) !== false // Local host
    || strpos($_SERVER['SERVER_NAME'], TST_SRV) !== false)  // Test host
{
  $version = time();
}
define("APP_VERSION", $version);


/* Default Values */
//define("LANGDEFAULT", "2"); // Language : 2 = English
//define("CDLANGDEFAULT", "EN"); // Language : EN = English
define("LANGDEFAULT", "1"); // Language : 1 = French
define("CDLANGDEFAULT", "FR"); // Language : FR = French
define("COUNTRY_CH", "44"); // 44 is the id in the table "country" in the database
define("COUNTRY_FR", "77"); // 77 is the id in the table "country" in the database

?>

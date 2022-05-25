<?php // Needed to encode in UTF8 ààéàé //
if (!defined('DISTRIX_LANG_DEFAULT')) define("DISTRIX_LANG_DEFAULT", "FR");

switch (DISTRIX_ENV) {
  case DISTRIX_ENV_DEV:
      if (!defined('URL_CDN_TEMPLATE_MAIL')) define("URL_CDN_TEMPLATE_MAIL", "http://localhost/DISTRIX_WEBSITE/");
      if (!defined('URL_DISTRIX_MAIL')) define("URL_DISTRIX_MAIL", "http://localhost/DISTRIX_WEBSITE/");
    break;
  case DISTRIX_ENV_INT:
    if (!defined('URL_CDN_TEMPLATE_MAIL')) define("URL_CDN_TEMPLATE_MAIL", "https://www.distrix.cloud/int/");
    if (!defined('URL_DISTRIX_MAIL')) define("URL_DISTRIX_MAIL", "https://www.distrix.cloud/int/");
    break;
  case DISTRIX_ENV_VER:
    if (!defined('URL_CDN_TEMPLATE_MAIL')) define("URL_CDN_TEMPLATE_MAIL", "https://www.distrix.cloud/ver/");
    if (!defined('URL_DISTRIX_MAIL')) define("URL_DISTRIX_MAIL", "https://www.distrix.cloud/ver/");
    break;
  case DISTRIX_ENV_VAL:
    if (!defined('URL_CDN_TEMPLATE_MAIL')) define("URL_CDN_TEMPLATE_MAIL", "https://www.distrix.cloud/val/");
    if (!defined('URL_DISTRIX_MAIL')) define("URL_DISTRIX_MAIL", "https://www.distrix.cloud/val/");
    break;
  case DISTRIX_ENV_PROD:
    if (!defined('URL_CDN_TEMPLATE_MAIL')) define("URL_CDN_TEMPLATE_MAIL", "https://www.distrix.cloud/");
    if (!defined('URL_DISTRIX_MAIL')) define("URL_DISTRIX_MAIL", "https://www.distrix.cloud/");
    break;
  default:
    break;
}
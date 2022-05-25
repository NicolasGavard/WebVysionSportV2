<?php
switch (DISTRIX_ENV) {
  case DISTRIX_ENV_DEV:
    if (!defined('DISTRIX_CDN_URL_IMAGES')) {
      define("DISTRIX_CDN_URL_IMAGES", "http://localhost/DISTRIX_WEBSITE/DistriXCdn/sent/images/");
    }
    if (!defined('DISTRIX_CDN_URL_MOVIES')) {
      define("DISTRIX_CDN_URL_MOVIES", "http://localhost/DISTRIX_WEBSITE/DistriXCdn/sent/movies/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES", "../Sent/Images/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES", "../Sent/Movies/");
    }
    break;
  case DISTRIX_ENV_INT:
    if (!defined('DISTRIX_CDN_URL_IMAGES')) {
      define("DISTRIX_CDN_URL_IMAGES", "https://www.pazzidjango.com/DISTRIX_WEBSITE/DistriXCdn/sent/images/");
    }
    if (!defined('DISTRIX_CDN_URL_MOVIES')) {
      define("DISTRIX_CDN_URL_MOVIES", "https://www.pazzidjango.com/DISTRIX_WEBSITE/DistriXCdn/sent/movies/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES", "../../images/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES", "../../movies/");
    }
    break;
  case DISTRIX_ENV_VER:
    if (!defined('DISTRIX_CDN_URL_IMAGES')) {
      define("DISTRIX_CDN_URL_IMAGES", "https://www.pazzidjango.com/DISTRIX_WEBSITE/DistriXCdn/sent/images/");
    }
    if (!defined('DISTRIX_CDN_URL_MOVIES')) {
      define("DISTRIX_CDN_URL_MOVIES", "https://www.pazzidjango.com/DISTRIX_WEBSITE/DistriXCdn/sent/movies/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES", "../../images/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES", "../../movies/");
    }
    break;
  case DISTRIX_ENV_VAL:
    if (!defined('DISTRIX_CDN_URL_IMAGES')) {
      define("DISTRIX_CDN_URL_IMAGES", "https://www.pazziman.com/DISTRIX_WEBSITE/DistriXCdn/sent/images/");
    }
    if (!defined('DISTRIX_CDN_URL_MOVIES')) {
      define("DISTRIX_CDN_URL_MOVIES", "https://www.pazziman.com/DISTRIX_WEBSITE/DistriXCdn/sent/movies/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES", "../../images/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES", "../../movies/");
    }
    break;
  case DISTRIX_ENV_PROD:
    if (!defined('DISTRIX_CDN_URL_IMAGES')) {
      define("DISTRIX_CDN_URL_IMAGES", "https://www.pazzicdn.com/images/");
    }
    if (!defined('DISTRIX_CDN_URL_MOVIES')) {
      define("DISTRIX_CDN_URL_MOVIES", "https://www.pazzicdn.com/movies/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES", "../../../images/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES", "../../../movies/");
    }
    break;
  default:
    if (!defined('DISTRIX_CDN_URL_IMAGES')) {
      define("DISTRIX_CDN_URL_IMAGES", "http://localhost/DISTRIX_WEBSITE/DistriXCdn/sent/images/");
    }
    if (!defined('DISTRIX_CDN_URL_MOVIES')) {
      define("DISTRIX_CDN_URL_MOVIES", "http://localhost/DISTRIX_WEBSITE/DistriXCdn/sent/movies/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES", "../Sent/Images/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES", "../Sent/Movies/");
    }
    break;
}

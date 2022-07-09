<?php
switch (DISTRIX_ENV) {
  case DISTRIX_ENV_DEV:
    if (!defined('DISTRIX_CDN_URL_IMAGES')) {
      define("DISTRIX_CDN_URL_IMAGES", "http://localhost/WebVysionSportV2/DistriX/DistriXCdn/Sent/Images/");
    }
    if (!defined('DISTRIX_CDN_URL_MOVIES')) {
      define("DISTRIX_CDN_URL_MOVIES", "http://localhost/WebVysionSportV2/DistriX/DistriXCdn/Sent/Movies/");
    }
    if (!defined('DISTRIX_CDN_URL_AUDIOS')) {
      define("DISTRIX_CDN_URL_AUDIOS", "http://localhost/WebVysionSportV2/DistriX/DistriXCdn/Sent/Audios/");
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
      define("DISTRIX_CDN_URL_IMAGES", "https://www.pazzidjango.com/WebVysionSportV2/DistriX/DistriXCdn/Sent/Images/");
    }
    if (!defined('DISTRIX_CDN_URL_MOVIES')) {
      define("DISTRIX_CDN_URL_MOVIES", "https://www.pazzidjango.com/WebVysionSportV2/DistriX/DistriXCdn/Sent/Movies/");
    }
    if (!defined('DISTRIX_CDN_URL_AUDIOS')) {
      define("DISTRIX_CDN_URL_AUDIOS", "https://www.pazzidjango.com/WebVysionSportV2/DistriX/DistriXCdn/Sent/Audios/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES", "../../Images/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES", "../../Movies/");
    }
    break;
  case DISTRIX_ENV_VER:
    if (!defined('DISTRIX_CDN_URL_IMAGES')) {
      define("DISTRIX_CDN_URL_IMAGES", "https://www.pazzidjango.com/WebVysionSportV2/DistriX/DistriXCdn/Sent/Images/");
    }
    if (!defined('DISTRIX_CDN_URL_MOVIES')) {
      define("DISTRIX_CDN_URL_MOVIES", "https://www.pazzidjango.com/WebVysionSportV2/DistriX/DistriXCdn/Sent/Movies/");
    }
    if (!defined('DISTRIX_CDN_URL_AUDIOS')) {
      define("DISTRIX_CDN_URL_AUDIOS", "https://www.pazzidjango.com/WebVysionSportV2/DistriX/DistriXCdn/Sent/Audios/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES", "../../Images/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES", "../../Movies/");
    }
    break;
  case DISTRIX_ENV_VAL:
    if (!defined('DISTRIX_CDN_URL_IMAGES')) {
      define("DISTRIX_CDN_URL_IMAGES", "https://www.pazziman.com/WebVysionSportV2/DistriX/DistriXCdn/Sent/Images/");
    }
    if (!defined('DISTRIX_CDN_URL_MOVIES')) {
      define("DISTRIX_CDN_URL_MOVIES", "https://www.pazziman.com/WebVysionSportV2/DistriX/DistriXCdn/Sent/Movies/");
    }
    if (!defined('DISTRIX_CDN_URL_AUDIOS')) {
      define("DISTRIX_CDN_URL_AUDIOS", "https://www.pazziman.com/WebVysionSportV2/DistriX/DistriXCdn/Sent/Audios/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES", "../../Images/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES", "../../Movies/");
    }
    break;
  case DISTRIX_ENV_PROD:
    if (!defined('DISTRIX_CDN_URL_IMAGES')) {
      define("DISTRIX_CDN_URL_IMAGES", "https://www.distrix.cloud/WebVysionSport/DistriX/DistriXCdn/Sent/Images/");
    }
    if (!defined('DISTRIX_CDN_URL_MOVIES')) {
      define("DISTRIX_CDN_URL_MOVIES", "https://www.distrix.cloud/WebVysionSport/DistriX/DistriXCdn/Sent/Movies/");
    }
    if (!defined('DISTRIX_CDN_URL_AUDIOS')) {
      define("DISTRIX_CDN_URL_AUDIOS", "https://www.distrix.cloud/WebVysionSport/DistriX/DistriXCdn/Sent/Audios/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_IMAGES", "../../../Images/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_MOVIES", "../../../Movies/");
    }
    if (!defined('DISTRIX_CDN_URL_UP_TO_FOLDER_AUDIOS')) {
      define("DISTRIX_CDN_URL_UP_TO_FOLDER_AUDIOS", "../../../Audios/");
    }
    break;
  default:
    break;
}

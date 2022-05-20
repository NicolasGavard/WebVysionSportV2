<?php // Needed to encode in UTF8 ààéàé //
$DistriXLoggerSettings["running"]["ApiToken"]               = false;

$DistriXLoggerSettings["running"]["Security_Application"]   = false;
$DistriXLoggerSettings["running"]["Security_Enterprise"]    = false;
$DistriXLoggerSettings["running"]["Security_Functionality"] = false;
$DistriXLoggerSettings["running"]["Security_Login"]         = false;
$DistriXLoggerSettings["running"]["Security_Module"]        = false;
$DistriXLoggerSettings["running"]["Security_Right"]         = false;
$DistriXLoggerSettings["running"]["Security_Role"]          = false;
$DistriXLoggerSettings["running"]["Security_RoleRight"]     = false;
$DistriXLoggerSettings["running"]["Security_User"]          = false;
$DistriXLoggerSettings["running"]["Security_UserRight"]     = false;
$DistriXLoggerSettings["running"]["Security_UserRole"]      = false;
$DistriXLoggerSettings["running"]["Security_UserType"]      = false;

$DistriXLoggerSettings["logFilename"]                       = "Logger/Distrix";
$DistriXLoggerSettings["logExtension"]                      = ".log";
$DistriXLoggerSettings["logDaily"]                          = true;
$DistriXLoggerSettings["logAppend"]                         = true;
$DistriXLoggerSettings["logMessage"]                        = false;
$DistriXLoggerSettings["logInfo"]                           = false;
$DistriXLoggerSettings["logError"]                          = false;
$DistriXLoggerSettings["logWarning"]                        = false;
$DistriXLoggerSettings["logFormat"]                         = "[Date] [Time] [Type] [IpAddress] [Parameters] [Application] [Function] [Message]";

switch (DISTRIX_ENV) {
  case DISTRIX_ENV_DEV:
    // $DistriXLoggerSettings["running"]["ApiToken"] = false;
    // $DistriXLoggerSettings["running"]["Security"] = false;
    // $DistriXLoggerSettings["running"]["Rights"]   = false;
    // $DistriXLoggerSettings["running"]["Roles"]    = false;
    $DistriXLoggerSettings["logFilename"]        .= "Dev";
    $DistriXLoggerSettings["logMessage"]          = true;
    $DistriXLoggerSettings["logInfo"]             = true;
    $DistriXLoggerSettings["logError"]            = true;
    $DistriXLoggerSettings["logWarning"]          = true;
    break;

  case DISTRIX_ENV_VER:
    // $DistriXLoggerSettings["running"]["ApiToken"] = false;
    // $DistriXLoggerSettings["running"]["Security"] = false;
    $DistriXLoggerSettings["logFilename"]        .= "Ver";
    $DistriXLoggerSettings["logMessage"]          = true;
    $DistriXLoggerSettings["logError"]            = true;
    $DistriXLoggerSettings["logWarning"]          = true;
    break;

  case DISTRIX_ENV_VAL:
    // $DistriXLoggerSettings["running"]["ApiToken"] = false;
    // $DistriXLoggerSettings["running"]["Security"] = false;
    $DistriXLoggerSettings["logFilename"]        .= "Val";
    $DistriXLoggerSettings["logMessage"]          = true;
    $DistriXLoggerSettings["logError"]            = true;
    break;

  case DISTRIX_ENV_PROD:
    // $DistriXLoggerSettings["running"]["ApiToken"] = false;
    // $DistriXLoggerSettings["running"]["Security"] = false;
    $DistriXLoggerSettings["logError"]            = true;
    break;

  default:
    break;
}

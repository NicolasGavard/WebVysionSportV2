<?php // Needed to encode in UTF8 ààéàé //
$DistriXLoggerSettings["running"]["ApiToken"] = false;
$DistriXLoggerSettings["logFilename"]  = "Logger/ApiTokenSvc";
$DistriXLoggerSettings["logExtension"] = ".log";
$DistriXLoggerSettings["logDaily"]     = true;
$DistriXLoggerSettings["logAppend"]    = true;
$DistriXLoggerSettings["logEmergency"] = false;
$DistriXLoggerSettings["logCritical"]  = false;
$DistriXLoggerSettings["logError"]     = false;
$DistriXLoggerSettings["logAlert"]     = false;
$DistriXLoggerSettings["logWarning"]   = false;
$DistriXLoggerSettings["logNotice"]    = false;
$DistriXLoggerSettings["logInfo"]      = false;
$DistriXLoggerSettings["logDebug"]     = false;
$DistriXLoggerSettings["logFormat"]    = "[Date] [Time] [Type] [IpAddress] [Application] [Function] [Message]";

switch (DISTRIX_ENV) {
  case DISTRIX_ENV_DEV:
    $DistriXLoggerSettings["running"]["ApiToken"] = false;
    $DistriXLoggerSettings["running"]["Rights"] = false;
    $DistriXLoggerSettings["running"]["Roles"] = false;
    $DistriXLoggerSettings["logFilename"]  .= "Dev";
    $DistriXLoggerSettings["logEmergency"] = true;
    $DistriXLoggerSettings["logCritical"]  = true;
    $DistriXLoggerSettings["logError"]     = true;
    $DistriXLoggerSettings["logAlert"]     = true;
    $DistriXLoggerSettings["logWarning"]   = true;
    $DistriXLoggerSettings["logNotice"]    = true;
    $DistriXLoggerSettings["logInfo"]      = true;
    $DistriXLoggerSettings["logDebug"]     = true;
    break;

  case DISTRIX_ENV_INT:
    $DistriXLoggerSettings["running"]["ApiToken"] = false;
    $DistriXLoggerSettings["logFilename"]  .= "Ver";
    $DistriXLoggerSettings["logEmergency"] = true;
    $DistriXLoggerSettings["logCritical"]  = true;
    $DistriXLoggerSettings["logError"]     = true;
    break;

  case DISTRIX_ENV_VER:
    $DistriXLoggerSettings["running"]["ApiToken"] = false;
    $DistriXLoggerSettings["logFilename"]  .= "Ver";
    $DistriXLoggerSettings["logEmergency"] = true;
    $DistriXLoggerSettings["logCritical"]  = true;
    $DistriXLoggerSettings["logError"]     = true;
    break;

  case DISTRIX_ENV_VAL:
    $DistriXLoggerSettings["running"]["ApiToken"] = false;
    $DistriXLoggerSettings["logFilename"]  .= "Val";
    $DistriXLoggerSettings["logEmergency"]  = true;
    $DistriXLoggerSettings["logError"]      = true;
    break;

  case DISTRIX_ENV_PROD:
    $DistriXLoggerSettings["running"]["ApiToken"] = false;
    $DistriXLoggerSettings["logError"]      = true;
    break;

  default:
    break;
}

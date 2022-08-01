<?php // Needed to encode in UTF8 ààéàé //
$DistriXLoggerSettings["running"]["Login"] = true;
$DistriXLoggerSettings["logFilename"]   = __DIR__ . "/Security";
$DistriXLoggerSettings["logExtension"]  = ".log";
$DistriXLoggerSettings["logDaily"]      = true;
$DistriXLoggerSettings["logAppend"]     = true;
$DistriXLoggerSettings["logMessage"]    = true;
$DistriXLoggerSettings["logInfo"]       = true;
$DistriXLoggerSettings["logError"]      = true;
$DistriXLoggerSettings["logWarning"]    = true;
$DistriXLoggerSettings["logFormat"]     = "[Date] [Time] [Type] [IpAddress] [Parameters] [Application] [Function] [Message]";

switch (DISTRIX_ENV) {
  case DISTRIX_ENV_DEV:
    $DistriXLoggerSettings["running"]["Login"] = true;
    $DistriXLoggerSettings["logFilename"]  .= "Dev";
    $DistriXLoggerSettings["logMessage"]    = true;
    $DistriXLoggerSettings["logInfo"]       = true;
    $DistriXLoggerSettings["logError"]      = true;
    $DistriXLoggerSettings["logWarning"]    = true;
    break;

  case DISTRIX_ENV_VER:
    $DistriXLoggerSettings["running"]["Login"] = true;
    $DistriXLoggerSettings["logFilename"]  .= "Ver";
    $DistriXLoggerSettings["logMessage"]    = true;
    $DistriXLoggerSettings["logError"]      = true;
    $DistriXLoggerSettings["logWarning"]    = true;
    break;

  case DISTRIX_ENV_VAL:
    $DistriXLoggerSettings["running"]["Login"] = true;
    $DistriXLoggerSettings["logFilename"]  .= "Val";
    $DistriXLoggerSettings["logMessage"]    = true;
    $DistriXLoggerSettings["logError"]      = true;
    break;

  case DISTRIX_ENV_PROD:
    $DistriXLoggerSettings["running"]["Login"] = true;
    $DistriXLoggerSettings["logError"]      = true;
    break;

  default:
    break;
}

<?php // Needed to encode in UTF8 ààéàé //
include(__DIR__ . "/../../DistriXInit/DistriXSvcControllerInit.php");
// Error
include(__DIR__ . "/../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp         = [];
$error        = [];
$output       = [];
$outputok     = false;
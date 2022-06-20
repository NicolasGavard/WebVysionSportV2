<?php // Needed to encode in UTF8 ààéàé //
include(__DIR__ . "/../../DistriX/DistriXInit/DistriXSvcControllerInit.php");
// Error
include(__DIR__ . "/../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../DistriX/DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../DistriX/DistriXLogger/Data/DistriXLoggerInfoData.php");

$resp         = [];
$error        = [];
$output       = [];
$outputok     = false;

function logController(string $element, string $application, string $function, mixed $data): ?DistriXSvcErrorData
{
  $returnValue = null;
  if (DistriXLogger::isLoggerRunning(__DIR__ . "/../../DistriXLoggerSettings.php", $element)) {
    $logInfoData = new DistriXLoggerInfoData();
    $logInfoData->setLogIpAddress($_SERVER['REMOTE_ADDR']);
    $logInfoData->setLogApplication($application);
    $logInfoData->setLogFunction($function);
    $logInfoData->setLogData(print_r($data, true));
    $returnValue = DistriXLogger::log($logInfoData);
  }
  return $returnValue;
}
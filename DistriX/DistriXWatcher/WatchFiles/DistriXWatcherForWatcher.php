<?php
$data = new DistriXWatcherData();
switch (DISTRIX_ENV) {
  case DISTRIX_ENV_DEV:
    $data->setServerCall("http");
    $data->setServerAddress("localhost");
    $data->setServerDirectory("DistriX");
    break;
  case DISTRIX_ENV_INT:
    $data->setServerCall("http");
    $data->setServerAddress("localhost");
    $data->setServerDirectory("DistriX");
    break;
  case DISTRIX_ENV_VER:
    $data->setServerCall("http");
    $data->setServerAddress("localhost");
    $data->setServerDirectory("DistriX");
    break;
  case DISTRIX_ENV_VAL:
    $data->setServerCall("http");
    $data->setServerAddress("localhost");
    $data->setServerDirectory("DistriX");
    break;
  case DISTRIX_ENV_PROD:
    $data->setServerCall("http");
    $data->setServerAddress("localhost");
    $data->setServerDirectory("DistriX");
    break;
  default:
    break;
}
$data->setIdEnterprise(1);
$data->setFileToInclude("../MyWatcherForDemo.php");
$data->setExpectedReturnValue("Alive");
//$data->setLogSettingsFile("Watcher");

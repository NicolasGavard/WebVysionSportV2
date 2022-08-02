<?php
include(__DIR__ . "/../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");

$resp["isConnected"]  = DistriXStyAppInterface::logout();
echo json_encode($resp);
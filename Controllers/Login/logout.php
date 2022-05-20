<?php
include(__DIR__ . "/../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../DistriXSecurity/StyAppInterface/DistriXStyLogin.php");

$resp["isConnected"]  = DistriXStyLogin::logout();
echo json_encode($resp);
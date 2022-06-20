<?php
include(__DIR__ . "/../../../../DistriX/DistriXSvc/Config/DistriXFolderPath.php");
include(DISTRIX_FOLDER_PATH_FOR_CONTROLLER . "DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../../DistriX/DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");

$resp["isConnected"]  = DistriXStyAppInterface::logout();
echo json_encode($resp);
<?php
include(__DIR__ . "/../../DistriX/DistriXSvc/Config/DistriXEnv.php");
	/* VERSION VALUE */
$version = "1.01";
switch (DISTRIX_ENV) {
	case DISTRIX_ENV_DEV: 
	case DISTRIX_ENV_INT:
	case DISTRIX_ENV_VER:
		$version = time();
		break;
	default:
		break;
}
define("APP_VERSION", $version);

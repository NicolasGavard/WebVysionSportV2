<?php // Needed to encode in UTF8 ààéàé //
function getLocation(): string
{
  $location = "";
  switch (DISTRIX_ENV) {
    case DISTRIX_ENV_INT:
      $location = "Location: http://localhost/WebVysionSport/Front/page404.php";
      break;
    case DISTRIX_ENV_VER:
      $location = "Location: http://localhost/WebVysionSport/Front/page404.php";
      break;
    case DISTRIX_ENV_VAL:
      $location = "Location: http://localhost/WebVysionSport/Front/page404.php";
      break;
    case DISTRIX_ENV_PROD:
      $location = "Location: http://localhost/WebVysionSport/Front/page404.php";
      break;
    default:
      $location = "Location: http://localhost/WebVysionSport/Front/page404.php";
      break;
  }
  return $location;
}

// DISTRIX Init
if (! file_exists("../DistriXInit/DistriXSvcDataServiceInit.php")) {
  include(__DIR__ . "/../../DistrixSvc/Config/DistriXEnv.php");
  header(getLocation());
  exit(0);
}

include("../DistriXInit/DistriXSvcDataServiceInit.php");

if (! $dataSvc->isAuthorized()) {
  header(getLocation());
  exit(0);
}

// STY Const
include(__DIR__ . "/../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../GlobalData/ApplicationErrorData.php");
// Storage
include(__DIR__ . "/../../DistriXDbConnection/DistriXPDOConnection.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";
$dbConnection = null;
$errorData    = null;
$insere       = false;

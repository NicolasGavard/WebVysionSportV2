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
if (! file_exists(__DIR__."/../../../../DistriX/DistriXInit/DistriXSvcDataServiceInit.php")) {
  include(__DIR__ . "/../../../../DistriX/DistrixSvc/Config/DistriXEnv.php");
  header(getLocation());
  exit(0);
}

include(__DIR__."../../../../DistriXInit/DistriXSvcDataServiceInit.php");

if (! $dataSvc->isAuthorized()) {
  header(getLocation());
  exit(0);
}

// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";
$dbConnection = null;
$errorData    = null;
$insere       = false;

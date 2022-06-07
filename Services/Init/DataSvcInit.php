<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
if ($dataSvc->isAuthorized()) {
  // STY Const
  include(__DIR__ . "/../../DistrixSecurity/Const/DistriXStyKeys.php");
  // Error
  include(__DIR__ . "/../../GlobalData/ApplicationErrorData.php");
  // Storage
  include(__DIR__ . "/../../DistriXDbConnection/DistriXPDOConnection.php");

  $databasefile = __DIR__ . "/../Db/Infodb.php";
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
}
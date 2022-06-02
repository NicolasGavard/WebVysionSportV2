<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
  // STY Const
include(__DIR__ . "/../../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/../Data/FoodTypeStorData.php");
include(__DIR__ . "/../Data/FoodTypeNameStorData.php");
// Storage
include(__DIR__ . "/../../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/../Storage/FoodTypeStor.php");
include(__DIR__ . "/../Storage/FoodTypeNameStor.php");
// Trace Data
include(__DIR__ . "/../../../../DistriXTrace/data/DistriXTraceData.php");

$databasefile = __DIR__ . "/../../../../Services/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;
$insere       = false;

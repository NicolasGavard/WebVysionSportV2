<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// Trace Data
include(__DIR__ . "/../../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/../Storage/DietTemplateStor.php");
// STOR Data
include(__DIR__ . "/../Data/DietTemplateStorData.php");

$databasefile = __DIR__ . "/../../../../Services/Db/Infodb.php";
$dbConnection = null;
$errorData    = null;
$insere       = false;




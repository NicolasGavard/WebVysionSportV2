<?php
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// Const
include("../DistriXApiToken/Const/DistriXApiTokenConst.php");
// Error
include("Data/DistriXSvcErrorData.php");
// Data
include("../DistriXApiToken/Data/DistriXApiTokenData.php");
// StorData
include(__DIR__ . "/Data/ApiTokenApplicationStorData.php");
include(__DIR__ . "/Data/ApiTokenClientStorData.php");
include(__DIR__ . "/Data/ApiTokenTokenStorData.php");
// Storage
include("../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/ApiTokenApplicationStor.php");
include(__DIR__ . "/Storage/ApiTokenClientStor.php");
include(__DIR__ . "/Storage/ApiTokenTokenStor.php");

// ------------------------------------
// -----------L O G G E R ---------------

include("../DistriXLogger/DistriXLogger.php");
include("../DistriXLogger/Data/DistriXLoggerEmailData.php");
include("../DistriXLogger/Data/DistriXLoggerInfoData.php");
include("../DistriXLogger/Data/DistriXLoggerTypeData.php");

// ------------------------------------
// ------------------------------------


// ------------------------------------
// -----------T R A C E ---------------

include("../DistriXTrace/DistriXTrace.php");
include("../DistriXTrace/Data/DistriXTraceData.php");
const APPLICATION_NAME = "APITOKEN";
const DB_SCHEMA_NAME   = "APITOKEN";
include(__DIR__ . "/../Layers/DistriXApiTokenTraceSvcCaller.php");

// ------------------------------------
// ------------------------------------

const TOKEN_MAX_LENGTH = 80;

$databasefile = "../DistriXApiToken/Db/Infodbtoken.php";
$errorData    = null;

if ("generate" == $dataSvc->getMethodName()) {
  $dbConnection = null;
  $errortxt     = "";
  $insere       = false;
  $error        = false;

  $tokenData = $dataSvc->getParameter(DISTRIX_APITOKEN_GENERATION_DATA_NAME, "DistriXApiTokenData");

  $dbConnection = new DistriXPDOConnection($databasefile, "");
  if (is_null($dbConnection->getError())) {
    // ------------------------------------
    // ------------------------------------

    // ------------------------------------
    // -----------T R A C E ---------------

    // $trace = new DistriXTrace($idUser, APPLICATION_NAME, DB_SCHEMA_NAME);
    $trace = new DistriXTrace(0, APPLICATION_NAME, DB_SCHEMA_NAME);
    $trace->setManualTrace(false);
    // $trace->setCommitBefore(false);
    $trace->setDistriXCaller(new DistriXApiTokenTraceSvcCaller());
    $dbConnection->setTrace($trace);

    // ------------------------------------
    // ------------------------------------

    $applicationStorData = new ApiTokenApplicationStorData();
    $applicationStorData->setCode($tokenData->getApplicationCode());
    $applicationStorData = ApiTokenApplicationStor::findByCode($applicationStorData, $dbConnection);

    $clientStorData = DistriXSvcUtil::setData($tokenData, "ApiTokenClientStorData");
    $clientStorData->setIdApiTokenApplication($applicationStorData->getId());
    $clientStorData = ApiTokenClientStor::findByClientIdApplication($clientStorData, $dbConnection);
    if ($clientStorData->getId() > 0) { // Found
      // Compare given keys to database keys
      // How to use keys to generate the token
      if ($dbConnection->beginTransaction()) {
        $tokenStorData = new ApiTokenTokenStorData();
        $tokenStorData->setIdApiTokenClient($clientStorData->getId());
        $token = DistriXSvcUtil::generateRandomText(TOKEN_MAX_LENGTH);
        if (strlen($tokenData->getSecretKey()) > 0) {
          $token[0] = $tokenData->getSecretKey()[0];
        } else {
          if (strlen($tokenData->getTestKey()) > 0) {
            $token[0] = $tokenData->getTestKey()[0];
          }
        }
        $tokenStorData->setToken($token);
        $tokenStorData->setTokenDate(DistriXSvcUtil::getCurrentNumDate());
        $tokenStorData->setTokenTime(DistriXSvcUtil::getCurrentNumTime());
        list($insere, $id) = ApiTokenTokenStor::save($tokenStorData, $dbConnection);

        if ($insere) {
          if ($dbConnection->commit()) {
            $tokenData->setToken($tokenStorData->getToken());
            $tokenData->setTokenDate($tokenStorData->getTokenDate());
            $tokenData->setTokenTime($tokenStorData->getTokenTime());
            $tokenData->setValid(true);
          } else {
            $errorData = new DistriXSvcErrorData();
            $errorData->setApplicationCode(DISTRIX_APITOKEN_COMMIT);
            if ($dbConnection->getError()->getCode() == "Database_Commit") {
              $errorData->setDefaultText("Api Token Generation Commit error !");
              $errorData->setText("Api Token Generation commit error !");
            }
            if ($dbConnection->getError()->getCode() == "Database_Trace_Commit") {
              $errorData->setDefaultText("Api Token Generation Trace Commit error !");
              $errorData->setText("Api Token Generation Trace Commit error !");
            }
          }
        } else {
          $dbConnection->rollBack();
          $errorData = new DistriXSvcErrorData();
          $errorData->setApplicationCode(DISTRIX_APITOKEN_ROLLBACK);
          $errorData->setDefaultText("Api Token Generation rollback !");
          $errorData->setText("Api Token Generation rollback !");
        }
      } else {
        $errorData = new DistriXSvcErrorData();
        $errorData->setApplicationCode(DISTRIX_APITOKEN_NO_TRANSACTION);
        $errorData->setDefaultText("No database transaction available !");
        $errorData->setText("No database transaction available !");
      }
    } else {
      $errorData = new DistriXSvcErrorData();
      $errorData->setApplicationCode(DISTRIX_APITOKEN_CLIENT_ID_UNKNOWN);
      $errorData->setDefaultText("Client ID unknown !");
      $errorData->setText("Client ID unknown !");
    }
  } else {
    $errorData = $dbConnection->getError();
  }
  $dataSvc->addToResponse(DISTRIX_APITOKEN_GENERATION_DATA_NAME, $tokenData);
}

if ("verify" == $dataSvc->getMethodName()) {
  $dbConnection = null;
  $errortxt     = "";
  $insere       = false;
  $error        = false;

  $tokenData = $dataSvc->getParameter(DISTRIX_APITOKEN_VERIFY_DATA, "DistriXApiTokenData");

  $dbConnection = new DistriXPDOConnection($databasefile, "");
  if (is_null($dbConnection->getError())) {
    // print_r($tokenData);
    $applicationStorData = new ApiTokenApplicationStorData();
    $applicationStorData->setCode($tokenData->getApplicationCode());
    $applicationStorData = ApiTokenApplicationStor::findByCode($applicationStorData, $dbConnection);

    $clientStorData = DistriXSvcUtil::setData($tokenData, "ApiTokenClientStorData");
    $clientStorData->setIdApiTokenApplication($applicationStorData->getId());
    $clientStorData = ApiTokenClientStor::findByClientIdApplication($clientStorData, $dbConnection);

    $tokenStorData = new ApiTokenTokenStorData();
    $tokenStorData->setIdApiTokenClient($clientStorData->getId());
    $tokenStorData->setToken($tokenData->getToken());
    $tokenStorData = ApiTokenTokenStor::findByIdApiTokenClient($tokenStorData, $dbConnection);

    if ($tokenStorData->getId() > 0) { // Found
      if ($dbConnection->beginTransaction()) {
        $tokenStorData->setTokenNbUse($tokenStorData->getTokenNbUse() + 1);
        list($insere, $id) = ApiTokenTokenStor::save($tokenStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          $errorData = new DistriXSvcErrorData();
          $errorData->setApplicationCode(DISTRIX_APITOKEN_ROLLBACK);
          $errorData->setDefaultText("Api Token Verification rollback !");
          $errorData->setText("Api Token Verification rollback !");
        }
      } else {
        $errorData = new DistriXSvcErrorData();
        $errorData->setApplicationCode(DISTRIX_APITOKEN_NO_TRANSACTION);
        $errorData->setDefaultText("No database transaction available !");
        $errorData->setText("No database transaction available !");
      }
    } else {
      $errorData = new DistriXSvcErrorData();
      $errorData->setApplicationCode(DISTRIX_APITOKEN_CLIENT_ID_UNKNOWN);
      $errorData->setDefaultText("Token unknown !");
      $errorData->setText("Token unknown !");
    }
  } else {
    $errorData = $dbConnection->getError();
  }
  $dataSvc->addToResponse(DISTRIX_APITOKEN_VERIFY_RESULT, $insere);
}

if ($errorData != null) {
  $dataSvc->addToResponse(DISTRIX_APITOKEN_ERROR, $errorData);
}
// Return response
$dataSvc->endOfService();

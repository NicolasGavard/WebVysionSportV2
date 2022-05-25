<?php
// Const
include("Const/DistriXApiTokenConst.php");
// Layers
include("Layers/DistriXApiTokenSvcCaller.php");
// Data
include("Data/DistriXApiTokenData.php");

if (!class_exists("DistriXApiToken", false)) {
  class DistriXApiToken
  {
    public static function generate(DistriXApiTokenData $tokenData): DistriXApiTokenData
    {
      $tokenCall = new DistriXApiTokenSvcCaller();
      $tokenCall->setServiceName("DistriXApiToken/Svc/DistriXApiTokenSvc.php");
      $tokenCall->setMethodName("generate");
      $tokenCall->addParameter(DISTRIX_APITOKEN_GENERATION_DATA_NAME, $tokenData);
      list($outputok, $busOutput, $errorData) = $tokenCall->call();
      // echo " ApiToken Svc-$outputok--------<br><br>";
      // echo " ApiToken Svc-" . print_r($busOutput, true) . "<br><br>";
      // echo " ApiToken Svc Error -" . print_r($errorData, true) . "<br><br>";
      if ($outputok) {
        if (isset($busOutput[DISTRIX_APITOKEN_GENERATION_DATA_NAME])) {
          $generatedTokenData = $busOutput[DISTRIX_APITOKEN_GENERATION_DATA_NAME];
          $tokenData->setToken($generatedTokenData->getToken());
          $tokenData->setValid($generatedTokenData->getValid());
          $tokenData->setTokenDate($generatedTokenData->getTokenDate());
          $tokenData->setTokenTime($generatedTokenData->getTokenTime());
        } else {
          $errorData = new DistriXSvcErrorData();
          $errorData->setCode(DISTRIX_APITOKEN_GENERATION_UNAVAILABLE);
          $errorData->setTextToAllText("Token unavailable !");
          $tokenData->setTokenError($errorData);
        }
      } else {
        $tokenData->setTokenError($errorData);
      }
      return $tokenData;
    }

    public static function verify(?DistriXApiTokenData $tokenData): bool
    {
      $isTokenValid = false;
      if (!is_null($tokenData)) {
        $tokenCall = new DistriXApiTokenSvcCaller();
        $tokenCall->setServiceName("DistriXApiToken/Svc/DistriXApiTokenSvc.php");
        $tokenCall->setMethodName("verify");
        $tokenCall->addParameter(DISTRIX_APITOKEN_VERIFY_DATA, $tokenData);
        list($outputok, $busOutput, $errorData) = $tokenCall->call();
        // echo " ApiToken Svc-$outputok--------<br><br>";
        // echo " ApiToken Svc-" . print_r($busOutput, true) . "<br><br>";
        // echo " ApiToken Svc Error -" . print_r($errorData, true) . "<br><br>";
        if ($outputok) {
          if (isset($busOutput[DISTRIX_APITOKEN_VERIFY_RESULT])) {
            $isTokenValid = $busOutput[DISTRIX_APITOKEN_VERIFY_RESULT];
          } else {
            $errorData = new DistriXSvcErrorData();
            $errorData->setCode(DISTRIX_APITOKEN_INVALID);
            $errorData->setTextToAllText("Invalid token !");
            $tokenData->setTokenError($errorData);
          }
        } else {
          $tokenData->setTokenError($errorData);
        }
      }
      return $isTokenValid;
    }
  }
  // End of class
}
// class_exists

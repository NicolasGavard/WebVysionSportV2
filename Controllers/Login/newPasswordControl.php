<?php
include(__DIR__ . "/../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../DistriXSecurity/Data/DistriXStyUserData.php");
// Error
include(__DIR__ . "/../../GlobalData/ApplicationErrorData.php");
// Distrix Crypto
include(__DIR__ . "/../../DistrixCrypto/DistriXCrypto.php");
include(__DIR__ . "/../../DistriXSecurity/Const/DistriXStyKeys.php");

$resp               = [];
$confirmCanChange   = false;

if (!empty($_POST['email']) && !empty($_POST['dateEnd'])) { 
  $email          = DistriXCrypto::decode($_POST['email'], DISTRIX_STY_KEY_AES);
  $dateEnd        = DistriXCrypto::decode($_POST['dateEnd'], DISTRIX_STY_KEY_AES);
  $dateEndExplode = explode("_", $dateEnd);
  $dateEnd        = $dateEndExplode[0];
  $timeEnd        = $dateEndExplode[1];

  if ($dateEnd = date('Ymd') && $timeEnd > date('His')) {
    $confirmCanChange = true;
  }
}

$resp["email"]            = $email;
$resp["dateEnd"]          = $dateEndExplode[0];
$resp["TimeEnd"]          = $dateEndExplode[1];
$resp["confirmCanChange"] = $confirmCanChange;

echo json_encode($resp);
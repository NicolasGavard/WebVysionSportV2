<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
include(__DIR__ . "/../../Const/DistriXStyMailConst.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyUserData.php");
// Database Data
include(__DIR__ . "/Data/StyUserStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserStor.php");
// Distrix Crypto
include(__DIR__ . "/../../../DistrixCrypto/DistriXCrypto.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// SendMailForgetPassword
if ($dataSvc->getMethodName() == "SendMailForgetPassword") {
  $dbConnection = null;
  $errorData    = null;
  $sendMail     = false;
  
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoUser     = $dataSvc->getParameter("data");
      $userStorData = DistriXSvcUtil::setData($infoUser, "StyUserStorData");
      
      $canSendMail  = false;
      // Verify Mail Exist
      if($infoUser->getEmail() != '' && !$canSendMail){
        $styUserStor = StyUserStor::findByEmail($userStorData, $dbConnection);
        if ($styUserStor->getId() > 0) {
          $canSendMail  = true;
        }
      }
      if($infoUser->getEmailBackup() != '' && !$canSendMail){
        $styUserStor = StyUserStor::findByEmailBackup($userStorData, $dbConnection);
        if ($styUserStor->getId() > 0) {
          $canSendMail  = true;
        }
      }
      
      if ($canSendMail) {
        // SendMail new account width temporary information
        $international  = "ForgetPassUser";
        $i18cdlangue    = 'FR';
        if ($infoUser->getIdLanguage() == 2) {
          $i18cdlangue  = 'EN';
        }
        
        $eMailRecipient = $infoUser->getEmail();
        if ($infoUser->getEmail() == '') {
          $eMailRecipient = $infoUser->getEmailBackup();
        }
        
        $dateNow          = date('Y-m-d H:i:s');
        $dateStart        = date('d/m/Y à H:i:s');
        $dateEnd          = date('d/m/Y à H:i:s',strtotime('+2 hours',strtotime($dateNow)));
        $dateEndCrypto    = date('Ymd_His',strtotime('+2 hours',strtotime($dateNow)));
        $eMailRecipCrypto = DistriXCrypto::encode($eMailRecipient, DISTRIX_STY_KEY_AES);
        $dateEndCrypto    = DistriXCrypto::encode($dateEndCrypto, DISTRIX_STY_KEY_AES);
        $link             = URL_DISTRIX_MAIL.'loginNewPassword.php?'.$eMailRecipCrypto.'|'.$dateEndCrypto;
        
        $i18cdlangue  = DISTRIX_LANG_DEFAULT;
        $filename     = "../../i18/$i18cdlangue/$international";
        $filename    .= "Txt$i18cdlangue.php";
        include(__DIR__ . "/../../../DistriXSecurity/styServices/Mails/".$filename);
        include(__DIR__ . "/../../../DistriXSecurity/styServices/Mails/header.php");
        include(__DIR__ . "/../../../DistriXSecurity/styServices/Mails/mailForgetPassUser.php");
        include(__DIR__ . "/../../../DistriXSecurity/styServices/Mails/footer.php");
        $message  = $header . $body . $footer;

        $subject  = $title;

        $headers    = 'Mime-Version: 1.0' . "\r\n";
        $headers   .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers   .= 'From: contact@distrix.cloud' . "\r\n";
        $headers   .= 'Reply-To: contact@distrix.cloud' . "\r\n";
        $headers   .= 'X-Mailer: PHP/' . phpversion();
        $headers   .= "\r\n";

        // try sendMail
        if(DISTRIX_ENV != DISTRIX_ENV_DEV){
          mail($eMailRecipient, $subject, $message, $headers);
          $sendMail = true;
        } else {
          file_put_contents(__DIR__ . "/../../../DistriXSecurity/styServices/Mails/mailForgetPassUser.htm", $message);
          $sendMail = true;
        }
      }
    } else {
      $errorData = ApplicationErrorData::noBeginTransaction(1, 1);
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }

  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "InitPassUser", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSendMail", $sendMail);
}

// Return response
$dataSvc->endOfService();

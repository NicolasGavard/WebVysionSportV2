<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/Const/DistriXStyKeys.php");
include(__DIR__ . "/../../Const/DistriXStyMailConst.php");
// Error
include(__DIR__ . "/../../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyEnterpriseData.php");
include(__DIR__ . "/../../Data/DistriXStyUserData.php");
// Database Data
include(__DIR__ . "/Data/StyEnterpriseStorData.php");
include(__DIR__ . "/Data/StyUserStorData.php");
include(__DIR__ . "/Data/StyUserRoleStorData.php");
include(__DIR__ . "/Data/StyUserRightStorData.php");
include(__DIR__ . "/Data/StyRoleRightStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyEnterpriseStor.php");
include(__DIR__ . "/Storage/StyUserStor.php");
include(__DIR__ . "/Storage/StyUserRoleStor.php");
include(__DIR__ . "/Storage/StyUserRightStor.php");
include(__DIR__ . "/Storage/StyRoleRightStor.php");
// Distrix Crypto
include(__DIR__ . "/../../../DistriXCrypto/DistriXCrypto.php");
// Distrix CDN
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

// SaveUser
if ($dataSvc->getMethodName() == "SaveUser") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoUser     = $dataSvc->getParameter("data");
      $userStorData = DistriXSvcUtil::setData($infoUser, "StyUserStorData");
      
      $canSaveUser  = true;
      if ($infoUser->getId() == 0) {
        // Verify Login Exist
        $styUserStor = StyUserStor::findByLogin($userStorData, $dbConnection);
        if ($styUserStor->getId() > 0) {
          $canSaveUser          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Login " . $infoUser->getLogin() . " is already in use");
          $distriXSvcErrorData->setText("LOGIN_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }

        // Verify Mail Exist
        if($infoUser->getEmail() != ''){
          $styUserStor = StyUserStor::findByEmail($userStorData, $dbConnection);
          if ($styUserStor->getId() > 0) {
            $canSaveUser          = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("The mail address " . $infoUser->getLogin() . " is already in use");
            $distriXSvcErrorData->setText("MAIL_ALREADY_IN_USE");
            $errorData = $distriXSvcErrorData;
          }
        }

        // Verify MailBackUp Exist
        if($infoUser->getEmailBackup() != ''){
          $styUserStor = StyUserStor::findByEmailBackup($userStorData, $dbConnection);
          if ($styUserStor->getId() > 0) {
            $canSaveUser          = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("The backup mail address " . $infoUser->getLogin() . " is already in use");
            $distriXSvcErrorData->setText("MAIL_BACKUP_ALREADY_IN_USE");
            $errorData = $distriXSvcErrorData;
          }
        }
      }

      if ($canSaveUser) {
        $styUserStor  = StyUserStor::read($infoUser->getId(), $dbConnection);
        $userStorData = new StyUserStorData();
        $userStorData->setId($infoUser->getId());
        $userStorData->setIdStyUserType($infoUser->getIdStyUserType());
        $userStorData->setLogin($infoUser->getLogin());
        $userStorData->setFirstName($infoUser->getFirstName());
        $userStorData->setName($infoUser->getName());
        $userStorData->setEmail($infoUser->getEmail());
        $userStorData->setEmailBackup($infoUser->getEmailBackup());
        $userStorData->setPhone($infoUser->getPhone());
        $userStorData->setMobile($infoUser->getMobile());
        $userStorData->setIdLanguage($infoUser->getIdLanguage());
        $userStorData->setIdStyEnterprise($infoUser->getIdStyEnterprise());

        if($infoUser->getPass() != ''){
          $pwd = DistriXCrypto::encodeOneWay(trim($infoUser->getPass()));
          $userStorData->setPass($pwd);
        } else {
          $userStorData->setPass($styUserStor->getPass());
          // Force InitPass for all new user without pass
          if ($infoUser->getId() == 0) {
            $userStorData->setInitPass(1);
          }
        }

        if ($infoUser->getLinkToPicture() != "" && $infoUser->getLinkToPicture() != $styUserStor->getLinkToPicture()) {
          $image          = file_get_contents($infoUser->getLinkToPicture());
          $imageInfo      = getimagesizefromstring($image);
          $imageExtension = str_replace("image/", "", $imageInfo['mime']);

          if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
            // $imageName    = $infoUser->getId() . '-' . $infoUser->getName() . '-' . $infoUser->getFirstName() . '.' . $imageExtension;
            $imageName    = DistriXSvcUtil::generateRandomText(50);
            $imageFile    = substr($infoUser->getLinkToPicture(), strpos($infoUser->getLinkToPicture(), ",") + 1);

            $cdn          = new DistriXCdn();
            $data         = new DistriXCdnData();
            $data->setImageGroup(DISTRIX_CDN_GROUP_IMAGES);
            $data->setImageFamily(DISTRIX_CDN_FOLDER_USERS);
            $data->setImageName($imageName);
            $data->setImageType($imageInfo['mime']);
            $data->setImage($imageFile);
            $added              = $cdn->addImage($data);
            $confirmSavePicture = $cdn->sendToCdn();

            if ($confirmSavePicture) {
              $userStorData->setLinkToPicture($imageName);
              $userStorData->setSize($imageInfo['bits']);
              $userStorData->setType($imageInfo['mime']);
            }
          } else {
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("Bad extension " . $imageExtension);
            $distriXSvcErrorData->setText("BAD_IMAGE_EXTENSION");
          }
        } else {
          $userStorData->setLinkToPicture($styUserStor->getLinkToPicture());
          $userStorData->setSize($styUserStor->getSize());
          $userStorData->setType($styUserStor->getType());
        }
        $userStorData->setTimestamp($styUserStor->getTimestamp());
        list($insere, $idStyUser) = StyUserStor::save($userStorData, $dbConnection);
        
        if ($infoUser->getId() > 0) $idStyUser = $infoUser->getId();
        
        // Si nouveau compte
        if ($insere && $infoUser->getId() == 0) {
          $eMailRecipientManager = '';
          // Compter le nombre de user de l'entreprise auquel il dépend
          list($styUserStorData, $styUserStorDataInd) = (new StyUserStor())->findByEnterpise($userStorData, true, $dbConnection);
          if ($styUserStorDataInd == 1) {
            // Si 0 alors idStyRole = 2 (ENT_MANAGER)
            $idStyRoleDefault    = 2;
            $styUserRoleStorData = new StyUserRoleStorData();
            $styUserRoleStorData->setIdStyUser($idStyUser);
            $styUserRoleStorData->setIdStyRole($idStyRoleDefault);
            list($insere, $idStyUserRole) = StyUserRoleStor::save($styUserRoleStorData, $dbConnection);
            
            if($insere){
              // Ajout de tous les userRight du role
              $styRoleRightStorData = new StyRoleRightStorData();
              $styRoleRightStorData->setIdStyRole($idStyRoleDefault);
              list($styRoleRightData, $styRoleRightDataInd) = (new StyRoleRightStor())->findByIndRole($styRoleRightStorData, $dbConnection);
              foreach ($styRoleRightData as $roleRight) {
                $styUserRightStorData = new StyUserRightStorData;
                $styUserRightStorData->setIdStyUser($idStyUser);
                $styUserRightStorData->setIdStyApplication($roleRight->getIdStyApplication());
                $styUserRightStorData->setIdStyModule($roleRight->getIdStyModule());
                $styUserRightStorData->setIdStyFunctionality($roleRight->getIdStyFunctionality());
                $styUserRightStorData->setSumOfRights($roleRight->getSumOfRights());
                list($insere, $id) = (new StyUserRightStor())->save($styUserRightStorData, $dbConnection);
              }
            }
            
            // Modification fichier enterprise avec l'idUserManager
            if($insere){
              $styEnterpriseStorData = (new StyEnterpriseStor())->read($infoUser->getIdStyEnterprise(), $dbConnection);
              $styEnterpriseStorData->setIdUserManager($idStyUser);
              list($insere, $idStyEnterprise) = StyEnterpriseStor::save($styEnterpriseStorData, $dbConnection);
            }
          }
        }
        
        $roles = $infoUser->getRoles();
        foreach ($roles as $role) {
          // Check if role exist
          $styUserRoleData = new StyUserRoleStorData();
          $styUserRoleData->setIdStyUser($idStyUser);
          $styUserRoleData->setIdStyRole($role->getId());
          list($styUserRoleStorData, $styUserRoleStorDataInd) = StyUserRoleStor::findByIndUserRole($styUserRoleData, $dbConnection);

          if ($styUserRoleStorDataInd == 0){
            // Creaation de tous roles, rights ....
            list($insere, $idStyUserRole) = StyUserRoleStor::save($styUserRoleStorData, $dbConnection);
          }
        }

        

        if ($insere && $infoUser->getId() == 0) {
          // SendMail new account width temporary information
          $international  = "NewUser";
          $i18cdlangue    = 'FR';
          if ($infoUser->getIdLanguage() == 2) {
            $i18cdlangue = 'EN';
          }

          $i18cdlangue  = DISTRIX_LANG_DEFAULT;
          $filename     = "../../i18/$i18cdlangue/$international";
          $filename    .= "Txt$i18cdlangue.php";
          include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/styServices/Mails/".$filename);
          include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/styServices/Mails/header.php");
          include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/styServices/Mails/mailNewUser.php");
          include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH ."DistriXSecurity/styServices/Mails/footer.php");
          $message  = $header . $body . $footer;

          $eMailRecipient = $infoUser->getEmail();
          if ($infoUser->getEmail() == '') {
            $eMailRecipient = $infoUser->getEmailBackup();
          }
          $subject  = $title;

          $headers    = 'Mime-Version: 1.0' . "\r\n";
          $headers   .= 'Content-type: text/html; charset=utf-8' . "\r\n";
          $headers   .= 'From: contact@distrix.cloud' . "\r\n";
          if ($eMailRecipientManager != '') {
            $headers .= 'Cc: '.$eMailRecipientManager.'' . "\r\n";
          }
          $headers   .= 'Reply-To: contact@distrix.cloud' . "\r\n";
          $headers   .= 'X-Mailer: PHP/' . phpversion();
          $headers   .= "\r\n";

          // try sendMail
          if(DISTRIX_ENV != DISTRIX_ENV_DEV){
            mail($eMailRecipient, $subject, $message, $headers);
          } else {
            file_put_contents(__DIR__ . "/../../../DistriXSecurity/styServices/Mails/NewUser.htm", $message);
          }
        }

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoUser->getId() > 0) {
            $errorData = ApplicationErrorData::warningUpdateData(1, 1);
          } else {
            $errorData = ApplicationErrorData::warningInsertData(1, 1);
          }
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

  $dataSvc->addToResponse("ConfirmSaveUser", $insere);
}

// SavePassUser
if ($dataSvc->getMethodName() == "SavePassUser") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoUser     = new DistriXStyUserData();
  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoUser         = $dataSvc->getParameter("data");
      $styUserStorData  = StyUserStor::read($infoUser->getId(), $dbConnection);
      $userStorData     = DistriXSvcUtil::setData($styUserStorData, "StyUserStorData");
      $pwd              = DistriXCrypto::encodeOneWay(trim($infoUser->getPass()));
      $userStorData->setPass(trim($pwd));
      $userStorData->setInitPass(0);
      list($insere, $idStyUser) = StyUserStor::save($userStorData, $dbConnection);
      
      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($infoUser->getId() > 0) {
          $errorData = ApplicationErrorData::warningUpdateData(1, 1);
        } else {
          $errorData = ApplicationErrorData::warningInsertData(1, 1);
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

  $dataSvc->addToResponse("ConfirmSaveUser", $insere);
}

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
// STY Const
include(__DIR__ . "/../../../DistriXSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
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
  $infoUser     = new DistriXStyUserData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoUser  = $dataSvc->getParameter("data");
      $canSaveUser  = true;
      if ($infoUser->getId() == 0) {
        // Verify Login Exist
        $styUserStor = StyUserStor::findByLogin($infoUser, $dbConnection);
        if ($styUserStor->getId() > 0) {
          $canSaveUser          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Login " . $infoUser->getLogin() . " is already in use");
          $distriXSvcErrorData->setText("LOGIN_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }

        // Verify Mail Exist
        $styUserStor = StyUserStor::findByEmail($infoUser, $dbConnection);
        if ($styUserStor->getId() > 0) {
          $canSaveUser          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The mail address " . $infoUser->getLogin() . " is already in use");
          $distriXSvcErrorData->setText("MAIL_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }

        // Verify MailBackUp Exist
        $styUserStor = StyUserStor::findByEmailBackup($infoUser, $dbConnection);
        if ($styUserStor->getId() > 0) {
          $canSaveUser          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The backup mail address " . $infoUser->getLogin() . " is already in use");
          $distriXSvcErrorData->setText("MAIL_BACKUP_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveUser) {
        $styUserStor = StyUserStor::read($infoUser->getId(), $dbConnection);

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
        $userStorData->setPass($styUserStor->getPass());

        // Force InitPass for all new user
        if ($infoUser->getId() == 0) $userStorData->setInitPass(1);

        if ($infoUser->getLinkToPicture() != "" && $infoUser->getLinkToPicture() != $styUserStor->getLinkToPicture()) {
          $image          = file_get_contents($infoUser->getLinkToPicture());
          $imageInfo      = getimagesizefromstring($image);
          $imageExtension = str_replace("image/", "", $imageInfo['mime']);

          if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
            $imageName    = $infoUser->getId() . '-' . $infoUser->getName() . '-' . $infoUser->getFirstName() . '.' . $imageExtension;
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

        if ($infoUser->getId() > 0) $idStyUsers = $infoUser->getId();

        if ($insere && $infoUser->getId() == 0) {
          $addRole = false;
          list($styUserRoleData, $styUserRoleDataInd) = (new StyUserRoleStor())->FindRoleUser($idStyUser, $dbConnection);

          // If account exist
          if ($styUserRoleDataInd > 0) {
            for ($indPr = 0; $indPr < $styUserRoleDataInd; $indPr++) {
              for ($indR = 0; $indR < count($infoUser->getRoles()); $indR++) {
                // If not same role
                if ($styUserRoleData[$indPr]->getIdStyRole() != $infoUser->getRoles()[$indR]->getIdStyRole()) {
                  $userRooleStorData  = new StyUserRoleStorData();
                  $userRooleStorData->setId($styUserRoleData[$indPr]->getId());
                  list($insere, $id) = (new StyUserRoleStor())->delete($userRooleStorData, $dbConnection);

                  if ($insere) {
                    $styUserRightData =  new StyUserRightStorData();
                    $styUserRightData->setIdStyUser($idStyUser);
                    list($styUserRightStorData, $styUserRightStorDataInd) = (new StyUserRightStor())->findByDatas($styUserRightData, $dbConnection);
                    for ($indRr = 0; $indRr < $styRoleRightStorDataInd; $indRr++) {
                      $styUserRightStorData = new StyUserRightStorData;
                      $styUserRightStorData->setId($styRoleRightStorData[$indRr]->getId());
                      list($insere, $id) = (new StyUserRightStor())->delete($styUserRightStorData, $dbConnection);
                    }
                    if ($insere) $addRole = true;
                  }
                }
              }
            }
          }

          // If account not exist
          if ($styUserRoleDataInd == 0 || $addRole) {
            $roles    = $infoUser->getRoles();
            $rolesInd = count($roles);

            for ($indR = 0; $indR < $rolesInd; $indR++) {
              $styUserRoleStorData = new StyUserRoleStorData();
              $styUserRoleStorData->setIdStyRole($roles[$indR]->getIdStyRole());
              $styUserRoleStorData->setIdStyUser($idStyUser);
              list($insere, $id) = (new StyUserRoleStor())->create($styUserRoleStorData, $dbConnection);

              if ($insere) {
                $styRoleRightStorData = new StyRoleRightStorData;
                $styRoleRightStorData->setIdStyRole($roles[$indR]->getIdStyRole());
                list($styRoleRightStorData, $styRoleRightStorDataInd) = (new StyRoleRightStor())->FindRoleRight($styRoleRightStorData, $dbConnection);
                for ($indRr = 0; $indRr < $styRoleRightStorDataInd; $indRr++) {
                  $styUserRightStorData = new StyUserRightStorData;
                  $styUserRightStorData->setIdStyUser($idStyUser);
                  $styUserRightStorData->setIdStyApplication($styRoleRightStorData[$indRr]->getIdStyApplication());
                  $styUserRightStorData->setIdStyModule($styRoleRightStorData[$indRr]->getIdStyModule());
                  $styUserRightStorData->setIdStyFunctionality($styRoleRightStorData[$indRr]->getIdStyFunctionality());
                  $styUserRightStorData->setSumOfRights($styRoleRightStorData[$indRr]->getSumOfRights());
                  list($insere, $id) = (new StyUserRightStor())->create($styUserRightStorData, $dbConnection);
                }
              }
            }
          }
        }

        if ($insere && $infoUser->getId() == 0) {
          // SendMail new account width temporary information
          $international  = "styLoginMailNewAccount";
          $i18cdlangue    = 'FR';
          if ($layerData->getIdLanguage() == 2) $i18cdlangue = 'EN';
          include(DJANGOSVC_TWO_LEVEL_UP . '_i18.php');

          include(DJANGOSVC_TWO_LEVEL_UP . "/Mails/header.php");
          include(DJANGOSVC_TWO_LEVEL_UP . "/Mails/_utilMailNewAccount.php");
          include(DJANGOSVC_TWO_LEVEL_UP . "/Mails/footer.php");
          $message  = $header . $body . $footer;

          $eMailRecipient = $infoUser->getEmail();
          if ($infoUser->getEmail() == '') $eMailRecipient = $infoUser->getEmailBackup();
          $subject  = $title;

          $headers  = 'Mime-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
          $headers .= 'From: contact@pazzi.co' . "\r\n";
          $headers .= 'Reply-To: contact@pazzi.co' . "\r\n";
          $headers .= 'X-Mailer: PHP/' . phpversion();
          $headers .= "\r\n";

          if (APP_ENV != APP_ENV_DEV) mail($eMailRecipient, $subject, $message, $headers);
          file_put_contents(DJANGOSVC_TWO_LEVEL_UP . 'Mails/_utilMailNewAccount.htm', $message);
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
      $userStorData->setPass(DistriXCrypto::encodeOneWay(trim($infoUser->getPass())));
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

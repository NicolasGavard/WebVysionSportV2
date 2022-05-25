<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../Const/DistriXStyKeys.php");
// STY Data
include(__DIR__ . "/../../Data/DistriXStyApplicationData.php");
include(__DIR__ . "/../../Data/DistriXStyInfoSessionData.php");
include(__DIR__ . "/../../Data/DistriXStyLoginData.php");
// Database Data
include(__DIR__ . "/Data/StyUserStorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXSvc/Trace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/StyUserStor.php");
// Distrix CDN
include(__DIR__ . "/../../../DistriXCdn/DistriXCdn.php");
include(__DIR__ . "/../../../DistriXCdn/Const/DistriXCdnFolderConst.php");
$databasefile = __DIR__ . "/../Db/Infodb.php";

// SaveUser
if ($dataSvc->getMethodName() == "SaveUser") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoSession  = new DistriXStyInfoSessionData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if ($dbConnection != null) {
    if ($dbConnection->beginTransaction()) {
      $infoSession  = $dataSvc->getParameter("data");
      $canSaveUser  = true;
      if ($infoSession->getIdUser() == 0) {
        // Verify Login Exist
        $styUserStor = StyUserStor::findByLogin($infoSession, $dbConnection);
        if ($styUserStor->getId() > 0) {
          $canSaveUser          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Login " . $infoSession->getLogin() . " is already in use");
          $distriXSvcErrorData->setText("LOGIN_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }


        // Verify Mail Exist
        $styUserStor = StyUserStor::findByEmail($infoSession, $dbConnection);
        if ($styUserStor->getId() > 0) {
          $canSaveUser          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The mail address " . $infoSession->getLogin() . " is already in use");
          $distriXSvcErrorData->setText("MAIL_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }

        // Verify MailBackUp Exist
        $styUserStor = StyUserStor::findByEmailBackup($infoSession, $dbConnection);
        if ($styUserStor->getId() > 0) {
          $canSaveUser          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The backup mail address " . $infoSession->getLogin() . " is already in use");
          $distriXSvcErrorData->setText("MAIL_BACKUP_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveUser) {
        $styUserStor = StyUserStor::read($infoSession->getIdUser(), $dbConnection);

        $userStorData = new StyUserStorData();
        $userStorData->setId($infoSession->getIdUser());
        $userStorData->setLogin($infoSession->getLogin());
        $userStorData->setFirstName($infoSession->getFirstName());
        $userStorData->setName($infoSession->getName());
        $userStorData->setEmail($infoSession->getEmail());
        $userStorData->setEmailBackup($infoSession->getEmailBackup());
        $userStorData->setPhone($infoSession->getPhone());
        $userStorData->setMobile($infoSession->getMobile());
        $userStorData->setIdLanguage($infoSession->getIdLanguage());
        $userStorData->setIdEnterprise($infoSession->getIdEnterprise());

        if ($infoSession->getPass() != "") {
          $userStorData->setPass($infoSession->getPass());
          $userStorData->setInitPass(0);
        } else {
          $userStorData->setPass($styUserStor->getPass());
        }

        // Force InitPass for all new user
        if ($infoSession->getIdUser() == 0) $userStorData->setInitPass(1);

        if ($infoSession->getLinkToPicture() != "" && $infoSession->getLinkToPicture() != $styUserStor->getLinkToPicture()) {
          $image          = file_get_contents($infoSession->getLinkToPicture());
          $imageInfo      = getimagesizefromstring($image);
          $imageExtension = str_replace("image/", "", $imageInfo['mime']);

          if ($imageExtension == "jpg" || $imageExtension == "png" || $imageExtension == "jpeg" || $imageExtension == "gif") {
            $imageName    = $infoSession->getIdUser() . '-' . $infoSession->getName() . '-' . $infoSession->getFirstName() . '.' . $imageExtension;
            $imageFile    = substr($infoSession->getLinkToPicture(), strpos($infoSession->getLinkToPicture(), ",") + 1);

            $cdn          = new DistriXCdn();
            $data         = new DistriXCdnData();
            $data->setImageGroup(DISTRIX_CDN_GROUP_IMAGES);
            $data->setImageFamily(DISTRIX_CDN_FOLDER_USER);
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

        if ($infoSession->getIdUser() > 0) $idStyUsers = $infoSession->getIdUser();

        if ($insere && $infoSession->getIdUser() == 0) {
          $addRole = false;
          list($styUserRoleData, $styUserRoleDataInd) = (new StyUserRoleStor())->FindRoleUser($idStyUser, $dbConnection);

          // If account exist
          if ($styUserRoleDataInd > 0) {
            for ($indPr = 0; $indPr < $styUserRoleDataInd; $indPr++) {
              for ($indR = 0; $indR < count($infoSession->getRoles()); $indR++) {
                // If not same role
                if ($styUserRoleData[$indPr]->getIdStyRole() != $infoSession->getRoles()[$indR]->getIdStyRole()) {
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
            $roles    = $infoSession->getRoles();
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

        if ($insere && $infoSession->getIdUser() == 0) {
          // SendMail new account width temporary information
          $international  = "styLoginMailNewAccount";
          $i18cdlangue    = 'FR';
          if ($layerData->getIdLanguage() == 2) $i18cdlangue = 'EN';
          include(DJANGOSVC_TWO_LEVEL_UP . '_i18.php');

          include(DJANGOSVC_TWO_LEVEL_UP . "/Mails/header.php");
          include(DJANGOSVC_TWO_LEVEL_UP . "/Mails/_utilMailNewAccount.php");
          include(DJANGOSVC_TWO_LEVEL_UP . "/Mails/footer.php");
          $message  = $header . $body . $footer;

          $eMailRecipient = $infoSession->getEmail();
          if ($infoSession->getEmail() == '') $eMailRecipient = $infoSession->getEmailBackup();
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
          if ($infoSession->getIdUser() > 0) {
            $errorData = ApplicationErrorData::warningUpdateData($layerData->getIdPos(), $layerData->getIdUser());
          } else {
            $errorData = ApplicationErrorData::warningInsertData($layerData->getIdPos(), $layerData->getIdUser());
          }
        }
      }
    } else {
      $errorData = ApplicationErrorData::noBeginTransaction($layerData->getIdPos(), $layerData->getIdUser());
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }

  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addToResponse("ApplicationError", $errorData);
  }

  $dataSvc->addToResponse("ConfirmSaveUser", $insere);
}

// Return response
$dataSvc->endOfService();

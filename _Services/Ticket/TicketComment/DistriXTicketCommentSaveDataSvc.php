<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/TicketCommentStorData.php");
  // Storage
  include(__DIR__ . "/Storage/TicketCommentStor.php");

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($ticketCommentStorData, $jsonError) = TicketCommentStorData::getJsonData($dataSvc->getParameter("data"));
    
    if ($jsonError->getCode() == "") {
      if ($dbConnection->beginTransaction()) {
        $canSave = true;
        $currentTicketCommentStorData = new TicketCommentStorData();

        if ($ticketCommentStorData->getId() == 0) {
          // Verify Code Exist
          $currentTicketCommentStorData = TicketCommentStor::findByIdUserCreateIdUserAssignDateTime($ticketCommentStorData, $dbConnection);
          if ($currentTicketCommentStorData->getId() > 0) {
            $canSave = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("The Code " . $ticketCommentStorData->getCode() . " is already in use");
            $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
            $errorData = $distriXSvcErrorData;
          }
        } else {
          // Verify no one has already modified the data
          $currentTicketCommentStorData = TicketCommentStor::read($ticketCommentStorData->getId(), $dbConnection);
          if ($ticketCommentStorData->getId() == $currentTicketCommentStorData->getId() 
           && $ticketCommentStorData->getTimestamp() != $currentTicketCommentStorData->getTimestamp()) {
            $canSave = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("401");
            $distriXSvcErrorData->setDefaultText("The data of " . $ticketCommentStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
            $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
            $errorData = $distriXSvcErrorData;
           }
        }
        if ($canSave) {
          $currentTicketCommentStorData = TicketCommentStor::read($ticketCommentStorData->getId(), $dbConnection);
          if (($ticketCommentStorData->getId() == $currentTicketCommentStorData->getId() 
              && $ticketCommentStorData->getTimestamp() == $currentTicketCommentStorData->getTimestamp())
              || ($ticketCommentStorData->getId() != $currentTicketCommentStorData->getId())) 
          {
            list($insere, $idTicketCommentStorData) = TicketCommentStor::save($ticketCommentStorData, $dbConnection);
          }
        }
        if ($canSave) {
          if ($insere) {
            $dbConnection->commit();
          } else {
            $dbConnection->rollBack();
            if ($ticketCommentStorData->getId() > 0) {
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
      $errorData = ApplicationErrorData::warningInsertData(1, 1);
    }
  } else {
    $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
  }
  if ($errorData != null) {
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveTicketComment", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ConfirmSave", $insere && $canSave);

  // Return response
  $dataSvc->endOfService();
}
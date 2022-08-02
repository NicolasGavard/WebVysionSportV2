<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
if ($dataSvc->isAuthorized()) {
  // Database Data
  include(__DIR__ . "/Data/TicketStorData.php");
  // Storage
  include(__DIR__ . "/Storage/TicketStor.php");

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    list($ticketStorData, $jsonError) = TicketStorData::getJsonData($dataSvc->getParameter("data"));
    
    if ($jsonError->getCode() == "") {
      if ($dbConnection->beginTransaction()) {
        $canSave = true;
        $currentTicketStorData = new TicketStorData();

        if ($ticketStorData->getId() == 0) {
          // Verify Code Exist
          $currentTicketStorData = TicketStor::findByIdUserCreateIdUserAssignDateTime($ticketStorData, $dbConnection);
          if ($currentTicketStorData->getId() > 0) {
            $canSave = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("400");
            $distriXSvcErrorData->setDefaultText("The Code " . $ticketStorData->getCode() . " is already in use");
            $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
            $errorData = $distriXSvcErrorData;
          }
        } else {
          // Verify no one has already modified the data
          $currentTicketStorData = TicketStor::read($ticketStorData->getId(), $dbConnection);
          if ($ticketStorData->getId() == $currentTicketStorData->getId() 
           && $ticketStorData->getTimestamp() != $currentTicketStorData->getTimestamp()) {
            $canSave = false;
            $distriXSvcErrorData = new DistriXSvcErrorData();
            $distriXSvcErrorData->setCode("401");
            $distriXSvcErrorData->setDefaultText("The data of " . $ticketStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
            $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
            $errorData = $distriXSvcErrorData;
           }
        }
        if ($canSave) {
          $currentTicketStorData = TicketStor::read($ticketStorData->getId(), $dbConnection);
          if (($ticketStorData->getId() == $currentTicketStorData->getId() 
              && $ticketStorData->getTimestamp() == $currentTicketStorData->getTimestamp())
              || ($ticketStorData->getId() != $currentTicketStorData->getId())) 
          {
            list($insere, $idTicketStorData) = TicketStor::save($ticketStorData, $dbConnection);
          }
        }
        if ($canSave) {
          if ($insere) {
            $dbConnection->commit();
          } else {
            $dbConnection->rollBack();
            if ($ticketStorData->getId() > 0) {
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
    $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveTicket", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }
  $dataSvc->addToResponse("ConfirmSave", $insere && $canSave);

  // Return response
  $dataSvc->endOfService();
}
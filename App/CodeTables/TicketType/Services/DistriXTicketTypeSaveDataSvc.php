<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/TicketTypeStorData.php");
include(__DIR__ . "/Data/TicketTypeNameStorData.php");
// Storage
include(__DIR__ . "/Storage/TicketTypeStor.php");
include(__DIR__ . "/Storage/TicketTypeNameStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($ticketTypeStorData, $jsonError) = TicketTypeStorData::getJsonData($dataSvc->getParameter("data"));
  list($ticketTypeNamesStorData, $jsonErrorName) = TicketTypeNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

  if ($jsonError->getCode() == "") {
    if ($dbConnection->beginTransaction()) {
      $canSave = true;
      $currentTicketTypeStorData = new TicketTypeStorData();

      if ($ticketTypeStorData->getId() == 0) {
        // Verify Code Exist
        $currentTicketTypeStorData = TicketTypeStor::findByCode($ticketTypeStorData, $dbConnection);
        if ($currentTicketTypeStorData->getId() > 0) {
          $canSave = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $ticketTypeStorData->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      } else {
        // Verify no one has already modified the data
        $currentTicketTypeStorData = TicketTypeStor::read($ticketTypeStorData->getId(), $dbConnection);
        if ($ticketTypeStorData->getId() == $currentTicketTypeStorData->getId() 
          && $ticketTypeStorData->getTimestamp() != $currentTicketTypeStorData->getTimestamp()) {
          $canSave = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("401");
          $distriXSvcErrorData->setDefaultText("The data of " . $ticketTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
          $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
          $errorData = $distriXSvcErrorData;
          }
      }
      if ($canSave) {
        $currentTicketTypeStorData = TicketTypeStor::read($ticketTypeStorData->getId(), $dbConnection);
        if (($ticketTypeStorData->getId() == $currentTicketTypeStorData->getId() && $ticketTypeStorData->getTimestamp() == $currentTicketTypeStorData->getTimestamp())
        || ($ticketTypeStorData->getId() != $currentTicketTypeStorData->getId())) {
          list($insere, $idTicketTypeStorData) = TicketTypeStor::save($ticketTypeStorData, $dbConnection);
          foreach ($ticketTypeNamesStorData as $ticketTypeNameStorData) {
            $ticketTypeNameStorData->setIdTicketType($idTicketTypeStorData);
            if ($ticketTypeNameStorData->getId() > 0) {
              $currentTicketTypeNameStorData = TicketTypeNameStor::read($ticketTypeNameStorData->getId(), $dbConnection);
              if ($ticketTypeNameStorData->getId() == $currentTicketTypeNameStorData->getId() 
              && $ticketTypeNameStorData->getTimestamp() != $currentTicketTypeNameStorData->getTimestamp()) {
                $canSave = false;
                $distriXSvcErrorData = new DistriXSvcErrorData();
                $distriXSvcErrorData->setCode("402");
                $distriXSvcErrorData->setDefaultText("The language data of " . $ticketTypeStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
                $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
                $errorData = $distriXSvcErrorData;
                break;
              }
            }
            list($insere, $idTicketTypeNameStorData) = TicketTypeNameStor::save($ticketTypeNameStorData, $dbConnection);
            if (!$insere) { break; }
          }
        }
      }
      if ($canSave) {
        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($ticketTypeStorData->getId() > 0) {
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveTicketType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ConfirmSave", $insere && $canSave);

// Return response
$dataSvc->endOfService();
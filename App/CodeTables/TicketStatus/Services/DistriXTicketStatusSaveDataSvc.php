<?php // Needed to encode in UTF8 ààéàé //
// Service Init
include(__DIR__ . "/../../../Init/DataSvcInit.php");
// Database Data
include(__DIR__ . "/Data/TicketStatusStorData.php");
include(__DIR__ . "/Data/TicketStatusNameStorData.php");
// Storage
include(__DIR__ . "/Storage/TicketStatusStor.php");
include(__DIR__ . "/Storage/TicketStatusNameStor.php");

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($ticketStatusStorData, $jsonError) = TicketStatusStorData::getJsonData($dataSvc->getParameter("data"));
  list($ticketStatusNamesStorData, $jsonErrorName) = TicketStatusNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));

  if ($jsonError->getCode() == "") {
    if ($dbConnection->beginTransaction()) {
      $canSave = true;
      $currentTicketStatusStorData = new TicketStatusStorData();

      if ($ticketStatusStorData->getId() == 0) {
        // Verify Code Exist
        $currentTicketStatusStorData = TicketStatusStor::findByCode($ticketStatusStorData, $dbConnection);
        if ($currentTicketStatusStorData->getId() > 0) {
          $canSave = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $ticketStatusStorData->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      } else {
        // Verify no one has already modified the data
        $currentTicketStatusStorData = TicketStatusStor::read($ticketStatusStorData->getId(), $dbConnection);
        if ($ticketStatusStorData->getId() == $currentTicketStatusStorData->getId() 
          && $ticketStatusStorData->getTimestamp() != $currentTicketStatusStorData->getTimestamp()) {
          $canSave = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("401");
          $distriXSvcErrorData->setDefaultText("The data of " . $ticketStatusStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
          $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
          $errorData = $distriXSvcErrorData;
          }
      }
      if ($canSave) {
        list($currentTicketStatusStorData, $listNames) = TicketStatusStor::readNames($ticketStatusStorData->getId(), $dbConnection);
        if (($ticketStatusStorData->getId() == $currentTicketStatusStorData->getId() && $ticketStatusStorData->getTimestamp() == $currentTicketStatusStorData->getTimestamp())
        || ($ticketStatusStorData->getId() != $currentTicketStatusStorData->getId())) {
          list($insere, $idTicketStatusStorData) = TicketStatusStor::save($ticketStatusStorData, $dbConnection);
          if (!empty($listNames)) {
            foreach ($listNames as $nameStorData) {
              $notFound = true;
              foreach ($ticketStatusNamesStorData as $ticketStatusNameStorData) {
                $ticketStatusNameStorData->setIdTicketStatus($idTicketStatusStorData);
                if ($ticketStatusNameStorData->getId() && $ticketStatusNameStorData->getId() == $nameStorData->getId()) {
                  $notFound = false;
                  if ($ticketStatusNameStorData->getTimestamp() != $nameStorData->getTimestamp()) {
                    $canSave = false;
                    $distriXSvcErrorData = new DistriXSvcErrorData();
                    $distriXSvcErrorData->setCode("402");
                    $distriXSvcErrorData->setDefaultText("The language data of " . $ticketStatusStorData->getCode() . " has been modified by another user. Please reload the data to see the modifications.");
                    $distriXSvcErrorData->setText("DATA_ALREADY_MODIFIED");
                    $errorData = $distriXSvcErrorData;
                    break;
                  }
                }
                list($insere, $idTicketStatusNameStorData) = TicketStatusNameStor::save($ticketStatusNameStorData, $dbConnection);
                if (!$insere) { break; }
              }
              if ($notFound) { // This language has been removed !
                  $insere = TicketStatusNameStor::delete($nameStorData->getId(), $dbConnection);
                  if (!$insere) { break; }
              }
            }
          }
        } else { // Currently no languages
          foreach ($ticketStatusNamesStorData as $ticketStatusNameStorData) {
            $ticketStatusNameStorData->setIdTicketStatus($idTicketStatusStorData);
            list($insere, $idTicketStatusNameStorData) = TicketStatusNameStor::save($ticketStatusNameStorData, $dbConnection);
            if (!$insere) { break; }
          }
        }
      }
      if ($canSave) {
        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($ticketStatusStorData->getId() > 0) {
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveTicketStatus", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ConfirmSave", $insere && $canSave);

// Return response
$dataSvc->endOfService();
<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
if ($dataSvc->isAuthorized()) {
  // STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Database Data
include(__DIR__ . "/Data/FoodTypeStorData.php");
include(__DIR__ . "/Data/FoodTypeNameStorData.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/FoodTypeStor.php");
include(__DIR__ . "/Storage/FoodTypeNameStor.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");

$databasefile  = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";
$dbConnection  = null;
$errorData     = null;
$insere        = false;
$foodType      = null;
$foodTypeNames = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  if (!is_null($dataSvc->getParameter("data"))) {
    list($foodTypeStor, $jsonError) = FoodTypeStorData::getJsonData($dataSvc->getParameter("data"));
  }
  if (!is_null($dataSvc->getParameter("dataNames"))) {
    list($foodTypeNamesStor, $jsonError) = FoodTypeNameStorData::getJsonArray($dataSvc->getParameter("dataNames"));
  }

// print_r($foodTypeStor);
// print_r($foodTypeNamesStor);

  if (! is_null($foodTypeStor)) {
    if ($dbConnection->beginTransaction()) {
      list($insere, $idFoodTypeStor) = FoodTypeStor::save($foodTypeStor, $dbConnection);
      if ($insere) {
        foreach ($foodTypeNamesStor as $foodTypeNameStor) {
          $foodTypeNameStor->setIdFoodType($idFoodTypeStor);
          list($insere, $idFoodTypeNameStor) = FoodTypeNameStor::save($foodTypeNameStor, $dbConnection);
          if (!$insere) { break; }
        }
        if (!$insere) {
          // Error with FoodTypeNames
        }
      } else {
        // Error with FoodType
      }
      if ($insere) {
        $dbConnection->commit();
      } else {
        $dbConnection->rollBack();
        if ($foodTypeStor->getId() > 0) {
          $errorData = ApplicationErrorData::warningUpdateData(1, 1);
        } else {
          $errorData = ApplicationErrorData::warningInsertData(1, 1);
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
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("Distrix", "SaveFoodType", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ConfirmSave", $insere);

// Return response
$dataSvc->endOfService();
}
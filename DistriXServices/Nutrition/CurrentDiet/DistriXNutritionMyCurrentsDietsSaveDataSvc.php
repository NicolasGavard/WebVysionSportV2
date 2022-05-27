<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/CurrentDietErrorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/DietStor.php");
// STOR Data
include(__DIR__ . "/Data/DietStorData.php");
// DISTRIX DATA STY
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
// DISTRIX DATA
include(__DIR__ . "/Data/DistriXNutritionCurrentDietData.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";

// SaveCurrentDiet
if ($dataSvc->getMethodName() == "SaveCurrentDiet") {
  $dbConnection = null;
  $errorData    = null;
  $insere       = false;
  $infoCurrentDiet     = new DistriXNutritionCurrentDietData();

  $dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
  if (is_null($dbConnection->getError())) {
    if ($dbConnection->beginTransaction()) {
      $infoCurrentDiet  = $dataSvc->getParameter("data");
      $dietStorData     = DistriXSvcUtil::setData($infoCurrentDiet, "CurrentDietStorData");
      $canSaveCurrentDiet  = true;
      if ($infoCurrentDiet->getId() == 0) {
        // Verify Code Exist
        list($styCurrentDietStor, $styCurrentDietStorInd) = DietStor::findByIdUserIdDietTemplateDateStart($dietStorData, true, $dbConnection);
        if ($styCurrentDietStorInd > 0) {
          $canSaveCurrentDiet          = false;
          $distriXSvcErrorData = new DistriXSvcErrorData();
          $distriXSvcErrorData->setCode("400");
          $distriXSvcErrorData->setDefaultText("The Code " . $infoCurrentDiet->getCode() . " is already in use");
          $distriXSvcErrorData->setText("CODE_ALREADY_IN_USE");
          $errorData = $distriXSvcErrorData;
        }
      }

      if ($canSaveCurrentDiet) {
        $dietStorData = new DietStorData();
        $dietStorData->setId($infoCurrentDiet->getId());
        $dietStorData->setCode($infoCurrentDiet->getCode());
        $dietStorData->setDescription($infoCurrentDiet->getDescription());
        $dietStorData->setStatut($infoCurrentDiet->getStatut());
        $dietStorData->setTimestamp($infoCurrentDiet->getTimestamp());
        list($insere, $idCurrentDiet) = DietStor::save($dietStorData, $dbConnection);

        if ($insere) {
          $dbConnection->commit();
        } else {
          $dbConnection->rollBack();
          if ($infoCurrentDiet->getId() > 0) {
            $errorData = CurrentDietErrorData::warningUpdateData(1, 1);
          } else {
            $errorData = CurrentDietErrorData::warningInsertData(1, 1);
          }
        }
      }
    } else {
      $errorData = CurrentDietErrorData::noBeginTransaction(1, 1);
    }
  } else {
    $errorData = CurrentDietErrorData::noDatabaseConnection(1, 32);
  }

  if ($errorData != null) {
    $errorData->setCurrentDietModuleFunctionalityCodeAndFilename("DistrixSty", "Login", $dataSvc->getMethodName(), basename(__FILE__));
    $dataSvc->addErrorToResponse($errorData);
  }

  $dataSvc->addToResponse("ConfirmSaveCurrentDiet", $insere);
}

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../../DistrixSecurity/Const/DistriXStyKeys.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Trace Data
include(__DIR__ . "/../../../DistriXTrace/data/DistriXTraceData.php");
// Error Data
include(__DIR__ . "/../../../DistriXSvc/Data/DistriXSvcErrorData.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// Storage
include(__DIR__ . "/../../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/DietStudentStor.php");
include(__DIR__ . "/Storage/DietTemplateStor.php");
// STOR Data
include(__DIR__ . "/Data/DietStudentStorData.php");
include(__DIR__ . "/Data/DietTemplateStorData.php");
// DISTRIX DATA STY
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
// DISTRIX DATA
include(__DIR__ . "/Data/DistriXNutritionTemplateDietData.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";

$dbConnection     = null;
$errorData        = null;
$myTemplatesDiets = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data                 = $dataSvc->getParameter("data");
  $dietTemplateStorData = DistriXSvcUtil::setData($data, "DietTemplateStorData");

  $showOld = false;
  if ($dietTemplateStorData->getStatus()) $showOld = true;

  list($dietTemplateStor, $dietTemplateStorInd) = DietTemplateStor::findByIdUser($dietTemplateStorData, $showOld, $dbConnection);
  foreach ($dietTemplateStor as $diet) {
    $currentDietAssignedUsers         = [];
    $distriXNutritionTemplateDietData = DistriXSvcUtil::setData($diet, "DistriXNutritionTemplateDietData");
        
    $dietStudentStorData = new DietStudentStorData();
    $dietStudentStorData->setIdDiet($diet->getId());
    list($dietStudentStor, $dietStudentStorInd) = DietStudentStor::findByIdDiet($dietStudentStorData, false, $dbConnection);
    $distriXNutritionTemplateDietData->setNbStudentAssigned($dietStudentStorInd);
    $myTemplatesDiets[]  = $distriXNutritionTemplateDietData;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListMyTemplatesDiets", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListMyTemplatesDiets", $myTemplatesDiets);

// Return response
$dataSvc->endOfService();

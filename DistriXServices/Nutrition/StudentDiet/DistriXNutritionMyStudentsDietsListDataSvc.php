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
// STOR Data
include(__DIR__ . "/Data/DietStorData.php");
include(__DIR__ . "/Data/DietStudentStorData.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";

$dbConnection     = null;
$errorData        = null;
$myStudentsDiets = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  list($data, $jsonError)       = DietStudentStorData::getJsonData($dataSvc->getParameter("data"));

  list($dietStudentStor, $dietStudentStorInd) = DietStudentStor::findByIdUser($dietStudentStorData, $dietStudentStorData->getElemState(), $dbConnection);
  foreach ($dietStudentStor as $diet) {
    $currentDietAssignedUsers         = [];
    $distriXNutritionStudentDietData = DistriXSvcUtil::setData($diet, "DistriXNutritionStudentDietData");
        
    $dietStudentStorData = new DietStudentStorData();
    $dietStudentStorData->setIdDiet($diet->getId());
    list($dietStudentStor, $dietStudentStorInd) = DietStudentStor::findByIdDiet($dietStudentStorData, false, $dbConnection);
    $distriXNutritionStudentDietData->setNbStudentAssigned($dietStudentStorInd);
    $myStudentsDiets[]  = $distriXNutritionStudentDietData;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListMyStudentsDiets", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListMyStudentsDiets", $myStudentsDiets);

// Return response
$dataSvc->endOfService();

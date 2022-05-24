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

$dbConnection = null;
$errorData    = null;
$distriXNutritionCurrentDietData = new DistriXNutritionCurrentDietData();

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data                             = $dataSvc->getParameter("data");
  $dietStor                         = DietStor::read($data->getId(), $dbConnection);
  $distriXNutritionCurrentDietData  = DistriXSvcUtil::setData($dietStor, "DistriXNutritionCurrentDietData");
  
  $dietStudentStorData = new DietStudentStorData();
  $dietStudentStorData->setIdDiet($dietStor->getId());
  list($dietStudentStor, $dietStudentStorInd) = DietStudentStor::findByIdDiet($dietStudentStorData, false, $dbConnection);
  foreach ($dietStudentStor as $student) {
    $infoUser                             = DistriXStyUser::viewUser($student->getIdUser());
    $distriXNutritionCurrentDietUsersData = new DistriXNutritionCurrentDietUsersData();
    $distriXNutritionCurrentDietUsersData->setIdUser($infoUser->getId());
    $distriXNutritionCurrentDietUsersData->setNameUser($infoUser->getName());
    $distriXNutritionCurrentDietUsersData->setFirstNameUser($infoUser->getFirstName());
    $currentDietAssignedUsers[] = $distriXNutritionCurrentDietUsersData;
  }
  $distriXNutritionCurrentDietData->setAssignedUsers($currentDietAssignedUsers);

} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ViewMyCurrentDiet", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ViewMyCurrentDiet", $distriXNutritionCurrentDietData);

// Return response
$dataSvc->endOfService();

<?php // Needed to encode in UTF8 ààéàé //
// DISTRIX Init
include("../DistriXInit/DistriXSvcDataServiceInit.php");
// STY Const
include(__DIR__ . "/../../DistrixSecurity/Const/DistriXStyKeys.php");
// STY APP
include(__DIR__ . "/../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../DistriXSecurity/Data/DistriXStyUserData.php");
// Error
include(__DIR__ . "/../../GlobalData/ApplicationErrorData.php");
// DATA
include(__DIR__ . "/Data/DistriXStudentCoatchUserData.php");
// Database Data
include(__DIR__ . "/Data/CoachUserStorData.php");
// Storage
include(__DIR__ . "/../../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/CoachUserStor.php");

$databasefile = __DIR__ . "/../Db/Infodb.php";

$dbConnection   = null;
$errorData      = null;
$listMyStudents = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $distriXStudentCoatchUserData = $dataSvc->getParameter("data");
  $coachUserStorData = new CoachUserStorData();
  $coachUserStorData->setStyIdUserCoach($distriXStudentCoatchUserData->getIdUserCoach());
  list($coachUserStorData, $coachUserStorDataInd) = CoachUserStor::findByStyIdUserCoach($coachUserStorData, false, $dbConnection);
  foreach ($coachUserStorData as $coachUser) {
    $distriXStudentCoatchUserData = new DistriXStudentCoatchUserData();
    $distriXStudentCoatchUserData->setId($coachUser->getId());
    $distriXStudentCoatchUserData->setIdUserCoach($coachUser->getStyIdUserCoach());
    
    $infoUser = DistriXStyUser::viewUser($coachUser->getStyIdUserCoach());
    $distriXStudentCoatchUserData->setNameUserCoach($infoUser->getName());
    $distriXStudentCoatchUserData->setFirstNameUserCoach($infoUser->getFirstName());
    
    $distriXStudentCoatchUserData->setIdUser($coachUser->getStyIdUser());
    $infoUser = DistriXStyUser::viewUser($coachUser->getStyIdUser());
    $distriXStudentCoatchUserData->setNameUser($infoUser->getName());
    $distriXStudentCoatchUserData->setFirstNameUser($infoUser->getFirstName());

    $distriXStudentCoatchUserData->setDateStart($coachUser->getDateStart());
    $distriXStudentCoatchUserData->setDateEnd($coachUser->getDateEnd());
    $distriXStudentCoatchUserData->setStatus($coachUser->getStatus());
    $distriXStudentCoatchUserData->setTimestamp($coachUser->getTimestamp());
    $listMyStudents[] = $distriXStudentCoatchUserData;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListApplications", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListMyStudents", $listMyStudents);

// Return response
$dataSvc->endOfService();

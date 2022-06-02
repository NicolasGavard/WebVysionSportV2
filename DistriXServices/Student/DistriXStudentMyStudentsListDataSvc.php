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
include(__DIR__ . "/Data/DistriXStudentCoachUserData.php");
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
  $distriXStudentCoachUserData = $dataSvc->getParameter("data");
  $coachUserStorData = new CoachUserStorData();
  $coachUserStorData->setStyIdUserCoach($distriXStudentCoachUserData->getIdUserCoach());
  list($coachUserStorData, $coachUserStorDataInd) = CoachUserStor::findByStyIdUserCoach($coachUserStorData, false, $dbConnection);
  foreach ($coachUserStorData as $coachUser) {
    $distriXStudentCoachUserData = new DistriXStudentCoachUserData();
    $distriXStudentCoachUserData->setId($coachUser->getId());
    $distriXStudentCoachUserData->setIdUserCoach($coachUser->getStyIdUserCoach());
    
    $infoUser = DistriXStyUser::viewUser($coachUser->getStyIdUserCoach());
    $distriXStudentCoachUserData->setNameUserCoach($infoUser->getName());
    $distriXStudentCoachUserData->setFirstNameUserCoach($infoUser->getFirstName());
    
    $distriXStudentCoachUserData->setIdUser($coachUser->getStyIdUser());
    $infoUser = DistriXStyUser::viewUser($coachUser->getStyIdUser());
    $distriXStudentCoachUserData->setNameUser($infoUser->getName());
    $distriXStudentCoachUserData->setFirstNameUser($infoUser->getFirstName());

    $distriXStudentCoachUserData->setDateStart($coachUser->getDateStart());
    $distriXStudentCoachUserData->setDateEnd($coachUser->getDateEnd());
    $distriXStudentCoachUserData->setElemState($coachUser->getElemState());
    $distriXStudentCoachUserData->setTimestamp($coachUser->getTimestamp());
    $listMyStudents[] = $distriXStudentCoachUserData;
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

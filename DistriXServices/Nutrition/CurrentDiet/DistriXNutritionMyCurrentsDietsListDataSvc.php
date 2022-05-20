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
include(__DIR__ . "/Storage/DietStor.php");
include(__DIR__ . "/Storage/DietStudentStor.php");
include(__DIR__ . "/Storage/DietTemplateStor.php");
// STOR Data
include(__DIR__ . "/Data/DietStorData.php");
include(__DIR__ . "/Data/DietStudentStorData.php");
include(__DIR__ . "/Data/DietTemplateStorData.php");
// DISTRIX DATA STY
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
// DISTRIX DATA
include(__DIR__ . "/Data/DistriXNutritionCurrentDietData.php");
include(__DIR__ . "/Data/DistriXNutritionCurrentDietUsersData.php");

$databasefile = __DIR__ . "/../../../DistriXServices/Db/Infodb.php";

$dbConnection = null;
$errorData    = null;
$myCurrentsDiets = [];

$dbConnection = new DistriXPDOConnection($databasefile, DISTRIX_STY_KEY_AES);
if (is_null($dbConnection->getError())) {
  $data         = $dataSvc->getParameter("data");
  $dietStorData = DistriXSvcUtil::setData($data, "DietStorData");

  $showOld = false;
  if ($dietStorData->getStatus()) $showOld = true;

  list($dietStor, $dietStorInd) = DietStor::findByIdUser($dietStorData, $showOld, $dbConnection);
  foreach ($dietStor as $diet) {
    $currentDietAssignedUsers         = [];
    $distriXNutritionCurrentDietData  = DistriXSvcUtil::setData($diet, "DistriXNutritionCurrentDietData");
    $dietTemplateStorData             = DietTemplateStor::read($diet->getIdDietTemplate(), $dbConnection);
    $distriXNutritionCurrentDietData->setName($dietTemplateStorData->getName());
    $distriXNutritionCurrentDietData->setDuration($dietTemplateStorData->getDuration());
    $distriXNutritionCurrentDietData->setTags($dietTemplateStorData->getTags());
    
    // Prendre date de la diet
    $date_start       = DistriXSvcUtil::getjmaDate($diet->getDateStart());
    $date_start       = $date_start[0].'-'.$date_start[1].'-'.$date_start[2];
    $date_rest        = new DateTime('now'); 
    // Ajouter le nombre de jour de la diet
    $duration         = $dietTemplateStorData->getDuration();
    // Trouver la date de fin
    $date_end         =  date('Y-m-d', strtotime($date_start. ' + '.$duration.' days'));
    $date_fin         = new DateTime($date_end);
    // Nombre de jours restant
    $interval         = $date_rest->diff($date_fin);
    $nbDaysInterval   = $interval->format('%d');
    // Faire pourcentage
    $advancement_rest = round(($nbDaysInterval / $duration) * 100, 2);
    $advancement_done = 100 - round($advancement_rest,2);
    $distriXNutritionCurrentDietData->setAdvancement(round($advancement_done));
    
    $dietStudentStorData = new DietStudentStorData();
    $dietStudentStorData->setIdDiet($diet->getId());
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
    $myCurrentsDiets[]  = $distriXNutritionCurrentDietData;
  }
} else {
  $errorData = ApplicationErrorData::noDatabaseConnection(1, 32);
}
if ($errorData != null) {
  $errorData->setApplicationModuleFunctionalityCodeAndFilename("DistrixSty", "ListMyCurrentsDiets", $dataSvc->getMethodName(), basename(__FILE__));
  $dataSvc->addErrorToResponse($errorData);
}
$dataSvc->addToResponse("ListMyCurrentsDiets", $myCurrentsDiets);

// Return response
$dataSvc->endOfService();

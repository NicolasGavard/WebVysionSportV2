<?php
include(__DIR__ . "/../../../DistriXInit/DistriXSvcControllerInit.php");
// STY APP
include(__DIR__ . "/../../../DistriXSecurity/StyAppInterface/DistriXStyUser.php");
// DATA
include(__DIR__ . "/../../../DistriXSecurity/Data/DistriXStyUserData.php");
include(__DIR__ . "/../../Data/DistriXNutritionCurrentDietData.php");
include(__DIR__ . "/../../Data/DistriXNutritionCurrentDietUsersData.php");
include(__DIR__ . "/../../Data/DistriXNutritionTemplateDietData.php");
// Error
include(__DIR__ . "/../../../GlobalData/ApplicationErrorData.php");
// Layer
include(__DIR__ . "/../../Layers/DistriXServicesCaller.php");
// DistriX LOGGER
include(__DIR__ . "/../../../DistriXLogger/DistriXLogger.php");
include(__DIR__ . "/../../../DistriXLogger/data/DistriXLoggerInfoData.php");

$resp               = [];
$error              = [];
$output             = [];
$outputok           = false;

$_POST['idUser']              = 1;
$listMyCurrentDiets           = [];
$listMyTemplateDiets          = [];
$listMyStudentsDiets          = [];
$listMyCurrentDietsFormFront  = [];

// Current Diet
list($distriXNutritionCurrentDietData, $errorJson)  = DistriXNutritionCurrentDietData::getJsonData($_POST);

$servicesCaller = new DistriXServicesCaller();
$servicesCaller->setMethodName("ListMyCurrentsDiets");
$servicesCaller->setServiceName("DistriXServices/Nutrition/CurrentDiet/DistriXNutritionMyCurrentsDietsListBusSvc.php");
$servicesCaller->addParameter("data", $distriXNutritionCurrentDietData);
list($outputok, $output, $errorData) = $servicesCaller->call(); print_r($output);

// Current Diet
if ($outputok && isset($output["ListMyCurrentsDiets"]) && is_array($output["ListMyCurrentsDiets"])) {
  list($listMyCurrentDiets, $jsonError) = DistriXNutritionCurrentDietData::getJsonArray($output["ListMyCurrentsDiets"]);
} else {
  $error = $errorData;
}
$resp["ListMyCurrentsDiets"]  = $listMyCurrentDiets;

// // Template Diet
// if ($outputok && isset($output["ListMyTemplatesDiets"]) && is_array($output["ListMyTemplatesDiets"])) {
//   list($listMyTemplateDiets, $jsonError) = DistriXNutritionTemplateDietData::getJsonArray($output["ListMyTemplatesDiets"]);
// } else {
//   $error = $errorData;
// }

// // Student Diet
// if ($outputok && isset($output["ListMyStudentsDiets"]) && is_array($output["ListMyStudentsDiets"])) {
//   list($listMyStudentsDiets, $jsonError) = DistriXNutritionCurrentDietUsersData::getJsonArray($output["ListMyStudentsDiets"]);
// } else {
//   $error = $errorData;
// }

// foreach ($listMyCurrentDiets as $currentDiet) {
//   $distriXNutritionCurrentDietData = new DistriXNutritionCurrentDietData();
//   $distriXNutritionCurrentDietData->setId($currentDiet->getId());
//   $distriXNutritionCurrentDietData->setIdUser($currentDiet->getIdUser());
//   $distriXNutritionCurrentDietData->setIdDietTemplate($currentDiet->getIdDietTemplate());
  
//   foreach ($listMyTemplateDiets as $templateDiet) {
//     if ($currentDiet->getIdDietTemplate() == $templateDiet->getId()) {
//       $distriXNutritionCurrentDietData->setName($templateDiet->getName());
//       $distriXNutritionCurrentDietData->setDuration($templateDiet->getDuration());
//       $distriXNutritionCurrentDietData->setTags($templateDiet->getTags());
//     }
//   }
//   $distriXNutritionCurrentDietData->setDateStart($currentDiet->getDateStart());
//   $distriXNutritionCurrentDietData->setAssignedUsers($assignedUsers);

//   $date_start       = DistriXSvcUtil::getjmaDate($diet->getDateStart());
//   $date_start       = $date_start[0].'-'.$date_start[1].'-'.$date_start[2];
//   $date_rest        = new DateTime('now'); 
//   // Ajouter le nombre de jour de la diet
//   $duration         = $dietTemplateStorData->getDuration();
//   // Trouver la date de fin
//   $date_end         =  date('Y-m-d', strtotime($date_start. ' + '.$duration.' days'));
//   $date_fin         = new DateTime($date_end);
//   // Nombre de jours restant
//   $interval         = $date_rest->diff($date_fin);
//   $nbDaysInterval   = $interval->format('%d');
//   // Faire pourcentage
//   $advancement_rest = round(($nbDaysInterval / $duration) * 100, 2);
//   $advancement_done = 100 - round($advancement_rest,2);

//   $distriXNutritionCurrentDietData->setAdvancement($advancement_done);
//   $distriXNutritionCurrentDietData->setElemState($currentDiet->getElemState());
//   $distriXNutritionCurrentDietData->setTimestamp($currentDiet->getTimestamp());
//   $listMyCurrentDietsFormFront[] = $distriXNutritionCurrentDietData;
// }

// $resp["ListMyCurrentsDiets"]  = $listMyCurrentDietsFormFront;
// $resp["ListMyTemplatesDiets"] = $listMyTemplateDiets;
// if(!empty($error)){
//   $resp["Error"]              = $error;
// }

echo json_encode($resp);
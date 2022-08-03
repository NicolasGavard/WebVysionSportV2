<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity//Data/DistriXStyUserData.php");
include(__DIR__ . "/../Data/DistriXCircuitTemplateData.php");
include(__DIR__ . "/../../MyCircuitsExercise/Data/DistriXCircuitExerciseData.php");
include(__DIR__ . "/../../MyExercises/Data/DistriXSportMyExerciseData.php");

$listUsers               = [];
$listMyExercises         = [];
$listMyCircuits          = [];
$listMyCircuitsFormFront = [];

$_POST['id'] = 1;

if (!empty($_POST) && isset($_POST)) {
  list($distriXCircuitTemplateData, $errorJson) = DistriXCircuitTemplateData::getJsonData($_POST);
  
  // Info profil
  $infoProfil                 = DistriXStyAppInterface::getUserInformation();
    
  // CALL
  $circuitCaller = new DistriXServicesCaller();
  $circuitCaller->setServiceName("App/Sport/MyCircuits/Services/DistriXSportMyCircuitsTemplateFindDataSvc.php");
  $circuitCaller->addParameter("data", $distriXCircuitTemplateData);
  
  $circuitExerciseCaller = new DistriXServicesCaller();
  $circuitExerciseCaller->setServiceName("App/Sport/MyCircuitsExercise/Services/DistriXSportMyCircuitsExerciseListDataSvc.php");

  $exerciseCaller = new DistriXServicesCaller();
  $exerciseCaller->setServiceName("App/Sport/MyExercises/Services/DistriXSportMyExercisesListDataSvc.php");
   
  $svc = new DistriXSvc();
  $svc->addToCall("circuit", $circuitCaller);
  $svc->addToCall("circuitExercise", $circuitExerciseCaller);
  $svc->addToCall("exercise", $exerciseCaller);
  $callsOk = $svc->call();

  list($outputok, $output, $errorData) = $svc->getResult("circuit"); //print_r($output);
  if ($outputok && isset($output["ListMyCircuitTemplates"]) && is_array($output["ListMyCircuitTemplates"])) {
    list($listMyCircuits, $jsonError) = DistriXCircuitTemplateData::getJsonArray($output["ListMyCircuitTemplates"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("circuitExercise"); //print_r($output);
  if ($outputok && isset($output["ListMyCircuitExercises"]) && is_array($output["ListMyCircuitExercises"])) {
    list($listMyCircuitsExercises, $jsonError) = DistriXCircuitExerciseData::getJsonArray($output["ListMyCircuitExercises"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("exercise"); //print_r($output);
  if ($outputok && isset($output["ListMyExercises"]) && is_array($output["ListMyExercises"])) {
    list($listMyExercises, $jsonError) = DistriXSportMyExerciseData::getJsonArray($output["ListMyExercises"]);
  } else {
    $error = $errorData;
  }

  foreach ($listMyCircuits as $myCircuits) {
    $distriXCircuitTemplateData = new DistriXCircuitTemplateData();
    $distriXCircuitTemplateData->setId($myCircuits->getId());

    if ($infoProfil->getId() == $myCircuits->getIdUserCoach()){
      $distriXCircuitTemplateData->setIdUserCoach($myCircuits->getIdUserCoach());
      $distriXCircuitTemplateData->setNameUserCoach($infoProfil->getName());
      $distriXCircuitTemplateData->setFirstNameUserCoach($infoProfil->getFirstName());

      $distriXCircuitTemplateData->setName($myCircuits->getName());
      $distriXCircuitTemplateData->setDescription($myCircuits->getDescription());
      $distriXCircuitTemplateData->setDuration($myCircuits->getDuration());
      $distriXCircuitTemplateData->setTags($myCircuits->getTags());

      $circuitsExercises = [];
      foreach ($listMyCircuitsExercises as $myCircuitsExercises) {
        $distriXCircuitExerciseData = new DistriXCircuitExerciseData();
        $distriXCircuitExerciseData->setId($myCircuitsExercises->getId());
        $distriXCircuitExerciseData->setIdCircuitTemplate($myCircuitsExercises->getIdCircuitTemplate());
        $distriXCircuitExerciseData->setNameCircuitTemplate($myCircuits->getName());
        
        foreach ($listMyExercises as $myExercises) {
          if ($myExercises->getId() == $myCircuitsExercises->getIdEexercise()) {
            $distriXCircuitExerciseData->setIdEexercise($myExercises->getId());
            $distriXCircuitExerciseData->setNameEexercise($myExercises->getName());
          }
        }
        $distriXCircuitExerciseData->setElemState($myCircuitsExercises->getElemState());
        $distriXCircuitExerciseData->setTimestamp($myCircuitsExercises->getTimestamp());
        $circuitsExercises[] = $distriXCircuitExerciseData;

      }
      $distriXCircuitTemplateData->setExercises($circuitsExercises);
      $distriXCircuitTemplateData->setElemState($myCircuits->getElemState());
      $distriXCircuitTemplateData->setTimestamp($myCircuits->getTimestamp());
      $listMyCircuitsFormFront[] = $distriXCircuitTemplateData;
    }    
  }
}

$resp["ListMyCircuits"] = $listMyCircuitsFormFront;
if(!empty($error)){
  $resp["Error"]                = $error;
}

echo json_encode($resp);
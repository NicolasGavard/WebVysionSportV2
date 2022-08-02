<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity//Data/DistriXStyUserData.php");
include(__DIR__ . "/../Data/CircuitExerciseData.php");
include(__DIR__ . "/../../MyCircuitsTemplate/Data/CircuitTemplateData.php");

$listUsers                      = [];
$listMyCircuitExercises         = [];
$listExercisesTypes             = [];
$listBodyMembersName            = [];
$listBodyMuscles                = [];
$listMyCircuitExerciseMusclesFormFront = [];
$listMyCircuitExercisesFormFront       = [];

if (!empty($_POST) && isset($_POST)) {
    // List Users
    $listUsers                            = DistriXStyAppUser::listUsers();
  
  // Info profil
  $infoProfil                           = DistriXStyAppInterface::getUserInformation();
  $distriXCodeTableBodyMemberNameData   = new DistriXCodeTableBodyMemberNameData();
  $distriXCodeTableBodyMemberNameData->setIdLanguage($infoProfil->getIdLanguage());
  $distriXCodeTableBodyMuscleNameData   = new DistriXCodeTableBodyMuscleNameData();
  $distriXCodeTableBodyMuscleNameData->setIdLanguage($infoProfil->getIdLanguage());
  $distriXCodeTableExerciseTypeNameData = new DistriXCodeTableExerciseTypeNameData();
  $distriXCodeTableExerciseTypeNameData->setIdLanguage($infoProfil->getIdLanguage());
  
  // Exercise
  list($distriXSportCurrentDietData, $errorJson)    = DistriXSportMyCircuitExerciseData::getJsonData($_POST);
  list($distriXSportExerciseMuscleData, $errorJson) = DistriXSportMyCircuitExercisesMusclesData::getJsonData($_POST);
  
  // CALL
  $exerciseCaller = new DistriXServicesCaller();
  $exerciseCaller->setServiceName("App/Sport/MyCircuitExercises/Services/DistriXSportMyCircuitExercisesListDataSvc.php");
  $exerciseCaller->addParameter("data", $distriXSportCurrentDietData);
  
  $exerciseMuscleCaller = new DistriXServicesCaller();
  $exerciseMuscleCaller->setServiceName("App/Sport/MyCircuitExercisesMuscles/Services/DistriXSportMyCircuitExercisesMusclesListDataSvc.php");
  $exerciseMuscleCaller->addParameter("data", $distriXSportExerciseMuscleData);

  $exerciseTypeCaller = new DistriXServicesCaller();
  $exerciseTypeCaller->setServiceName("App/CodeTables/SportExerciseType/Services/DistriXExerciseTypeListDataSvc.php");
  $exerciseTypeCaller->addParameter("dataName", $distriXCodeTableExerciseTypeNameData);

  $bodyMemberCaller = new DistriXServicesCaller();
  $bodyMemberCaller->setServiceName("App/CodeTables/SportBodyMember/Services/DistriXBodyMemberListDataSvc.php");
  $bodyMemberCaller->addParameter("dataName", $distriXCodeTableBodyMemberNameData);
  
  $bodyMuscleCaller = new DistriXServicesCaller();
  $bodyMuscleCaller->setServiceName("App/CodeTables/SportBodyMuscle/Services/DistriXBodyMuscleListDataSvc.php");
  $bodyMuscleCaller->addParameter("dataName", $distriXCodeTableBodyMuscleNameData);
   
  $svc = new DistriXSvc();
  $svc->addToCall("exercise", $exerciseCaller);
  $svc->addToCall("exerciseMuscle", $exerciseMuscleCaller);
  $svc->addToCall("exerciseType", $exerciseTypeCaller);
  $svc->addToCall("bodyMember", $bodyMemberCaller);
  $svc->addToCall("bodyMuscle", $bodyMuscleCaller);
  $callsOk = $svc->call();

  list($outputok, $output, $errorData) = $svc->getResult("exercise"); //print_r($output);
  if ($outputok && isset($output["ListMyCircuitExercises"]) && is_array($output["ListMyCircuitExercises"])) {
    list($listMyCircuitExercises, $jsonError) = DistriXSportMyCircuitExerciseData::getJsonArray($output["ListMyCircuitExercises"]);
  } else {
    $error = $errorData;
  }
  
  list($outputok, $output, $errorData) = $svc->getResult("exerciseMuscle"); //print_r($output);
  if ($outputok && isset($output["ListMyCircuitExerciseMuscles"]) && is_array($output["ListMyCircuitExerciseMuscles"])) {
    list($listMyCircuitExerciseMuscles, $jsonError) = DistriXSportMyCircuitExercisesMusclesData::getJsonArray($output["ListMyCircuitExerciseMuscles"]);
  } else {
    $error = $errorData;
  }
  
  list($outputok, $output, $errorData) = $svc->getResult("exerciseType"); //print_r($output);
  if ($outputok && isset($output["ListExerciseTypeNames"]) && is_array($output["ListExerciseTypeNames"])) {
    list($listExercisesTypes, $jsonError) = DistriXCodeTableExerciseTypeNameData::getJsonArray($output["ListExerciseTypeNames"]);
  } else {
    $error = $errorData;
  }

  list($outputok, $output, $errorData) = $svc->getResult("bodyMember"); //print_r($output);
  if ($outputok && isset($output["ListBodyMemberNames"]) && is_array($output["ListBodyMemberNames"])) {
    list($listBodyMembersName, $jsonError)  = DistriXCodeTableBodyMemberNameData::getJsonArray($output["ListBodyMemberNames"]);
  } else {
    $error = $errorData;
  }
  
  list($outputok, $output, $errorData) = $svc->getResult("bodyMuscle"); //print_r($output);
  if ($outputok && isset($output["ListBodyMuscleNames"]) && is_array($output["ListBodyMuscleNames"])) {
    list($listBodyMuscles, $jsonError)      = DistriXCodeTableBodyMuscleData::getJsonArray($output["ListBodyMuscles"]);
    list($listBodyMusclesName, $jsonError)  = DistriXCodeTableBodyMuscleNameData::getJsonArray($output["ListBodyMuscleNames"]);
  } else {
    $error = $errorData;
  }

  foreach ($listBodyMembersName as $bodyMembers) {
    $distriXCodeTableBodyMembersMusclesData = new DistriXCodeTableBodyMembersMusclesData();
    $distriXCodeTableBodyMembersMusclesData->setId($bodyMembers->getId());
    $distriXCodeTableBodyMembersMusclesData->setName($bodyMembers->getName());
    $distriXCodeTableBodyMembersMusclesData->setElemState($bodyMembers->getElemState());
    $distriXCodeTableBodyMembersMusclesData->setTimestamp($bodyMembers->getTimestamp());
    
    $muscles = [];
    foreach ($listBodyMuscles as $bodyMuscles) {
      if ($bodyMuscles->getIdBodyMember() == $bodyMembers->getIdBodyMember()){
        foreach ($listBodyMusclesName as $bodyMusclesName) {
          if ($bodyMusclesName->getIdBodyMuscle() == $bodyMuscles->getId()){
            $distriXCodeTableBodyMuscleNameData = new DistriXCodeTableBodyMuscleNameData();
            $distriXCodeTableBodyMuscleNameData->setId($bodyMusclesName->getIdBodyMuscle());
            $distriXCodeTableBodyMuscleNameData->setName($bodyMusclesName->getName());
            $muscles[] = $distriXCodeTableBodyMuscleNameData;
          }
        }
      }
    }
    $distriXCodeTableBodyMembersMusclesData->setMuscles($muscles);
    $listMyCircuitExerciseMusclesFormFront[] = $distriXCodeTableBodyMembersMusclesData;
  }

  foreach ($listMyCircuitExercises as $exercise) {
    foreach ($listUsers as $user) {
      if ($exercise->getIdUserCoach() == $user->getId()){
        $exercise->setNameUserCoach($user->getName());
        $exercise->setFirstNameUserCoach($user->getFirstName());
        break;
      }
    }

    foreach ($listExercisesTypes as $exerciseType) {
      if ($exerciseType->getIdExerciseType() == $exercise->getIdExerciseType()){
        $exercise->setNameExerciseType($exerciseType->getName());
        break;
      }
    }
    
    $exerciseMuscles = [];
    foreach ($listMyCircuitExerciseMuscles as $listExerciseMuscles) {
      if ($listExerciseMuscles->getIdExercise() == $exercise->getId()) {
        $distriXSportMyCircuitExercisesMusclesData = new DistriXSportMyCircuitExercisesMusclesData();
        $distriXSportMyCircuitExercisesMusclesData->setId($listExerciseMuscles->getId());
        $distriXSportMyCircuitExercisesMusclesData->setIdExercise($listExerciseMuscles->getIdExercise());
        $distriXSportMyCircuitExercisesMusclesData->setIdBodyMuscle($listExerciseMuscles->getIdBodyMuscle());
        foreach ($listBodyMusclesName as $bodyMusclesName) {
          if ($bodyMusclesName->getIdBodyMuscle() == $listExerciseMuscles->getIdBodyMuscle()){
            $distriXSportMyCircuitExercisesMusclesData->setNameBodyMuscle($bodyMusclesName->getName());
            break;
          }
        }
        $distriXSportMyCircuitExercisesMusclesData->setElemState($listExerciseMuscles->getElemState());
        $distriXSportMyCircuitExercisesMusclesData->setTimestamp($listExerciseMuscles->getTimestamp());
        $exerciseMuscles[] = $distriXSportMyCircuitExercisesMusclesData;
      }
    }
    $exercise->setExerciseMuscles($exerciseMuscles);
    $listMyCircuitExercisesFormFront[] = $exercise;
  }
}

$resp["ListMyCircuitExercisesTypes"]   = $listExercisesTypes;
$resp["ListMyCircuitExercisesMuscles"] = $listMyCircuitExerciseMusclesFormFront;
$resp["ListMyCircuitExercises"]        = $listMyCircuitExercisesFormFront;
if(!empty($error)){
  $resp["Error"]                = $error;
}

echo json_encode($resp);
<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity//Data/DistriXStyUserData.php");
include(__DIR__ . "/../Data/DistriXSportMyExerciseData.php");
include(__DIR__ . "/../../MyExercisesMuscles/Data/DistriXSportMyExercisesMusclesData.php");

include(__DIR__ . "/../../../CodeTables/SportBodyMember/Data/DistriXCodeTableBodyMemberData.php");
include(__DIR__ . "/../../../CodeTables/SportBodyMember/Data/DistriXCodeTableBodyMemberNameData.php");
include(__DIR__ . "/../../../CodeTables/SportBodyMuscle/Data/DistriXCodeTableBodyMuscleData.php");
include(__DIR__ . "/../../../CodeTables/SportBodyMuscle/Data/DistriXCodeTableBodyMuscleNameData.php");
include(__DIR__ . "/../../../CodeTables/SportBodyMember/Data/DistriXCodeTableBodyMembersMusclesData.php");
include(__DIR__ . "/../../../CodeTables/SportExerciseType/Data/DistriXCodeTableExerciseTypeNameData.php");

$listUsers                = [];
$listMyExercises          = [];
$listExercisesTypes       = [];
$listExercisesTypes       = [];
$listBodyMembersName      = [];
$listBodyMuscles          = [];
$listMyExercisesFormFront = [];

$_POST['id'] = 1;

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
  $distriXSportCurrentDietData = new DistriXSportMyExerciseData();
  $distriXSportCurrentDietData->setId($_POST['id']);

  $distriXSportExerciseMuscleData = new DistriXSportMyExercisesMusclesData();
  $distriXSportExerciseMuscleData->setIdExercise($_POST['id']);
  
  // CALL
  $exerciseCaller = new DistriXServicesCaller();
  $exerciseCaller->setServiceName("App/Sport/MyExercises/Services/DistriXSportMyExercisesViewDataSvc.php");
  $exerciseCaller->addParameter("data", $distriXSportCurrentDietData);
  
  $exerciseMuscleCaller = new DistriXServicesCaller();
  $exerciseMuscleCaller->setServiceName("App/Sport/MyExercisesMuscles/Services/DistriXSportMyExercisesMusclesListDataSvc.php");
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
  if ($outputok && isset($output["ViewMyCurrentExercise"]) && is_array($output["ViewMyCurrentExercise"])) {
    list($distriXSportMyExerciseData, $jsonError) = DistriXSportMyExerciseData::getJsonData($output["ViewMyCurrentExercise"]);
  } else {
    $error = $errorData;
  }
  
  list($outputok, $output, $errorData) = $svc->getResult("exerciseMuscle"); //print_r($output);
  if ($outputok && isset($output["ListMyExerciseMuscles"]) && is_array($output["ListMyExerciseMuscles"])) {
    list($listMyExerciseMuscles, $jsonError) = DistriXSportMyExercisesMusclesData::getJsonArray($output["ListMyExerciseMuscles"]);
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
    $listMyExerciseMusclesFormFront[] = $distriXCodeTableBodyMembersMusclesData;
  }

  foreach ($listMyExercises as $exercise) {
    $distriXSportMyExerciseData = new DistriXSportMyExerciseData();

    $distriXSportMyExerciseData->setId($exercise->getId());
    $distriXSportMyExerciseData->setIdUserCoach($exercise->getIdUserCoach());
    foreach ($listUsers as $user) {
      if ($exercise->getIdUserCoach() == $user->getId()){
        $distriXSportMyExerciseData->setNameUserCoach($user->getName());
        $distriXSportMyExerciseData->setFirstNameUserCoach($user->getFirstName());
        break;
      }
    }

    foreach ($listExercisesTypes as $exerciseType) {
      if ($exerciseType->getIdExerciseType() == $exercise->getIdExerciseType()){
        $distriXSportMyExerciseData->setNameExerciseType($exerciseType->getName());
        break;
      }
    }
    
    $distriXSportMyExerciseData->setCode($exercise->getCode());
    $distriXSportMyExerciseData->setName($exercise->getName());
    $distriXSportMyExerciseData->setLinkToPictureInternal($exercise->getLinkToPictureInternal());
    $distriXSportMyExerciseData->setLinkToPictureExternal($exercise->getLinkToPictureExternal());
    $distriXSportMyExerciseData->setSize($exercise->getSize());
    $distriXSportMyExerciseData->setType($exercise->getType());
    $distriXSportMyExerciseData->setDescription($exercise->getDescription());
    
    $exerciseMuscles = [];
    foreach ($listMyExerciseMuscles as $listExerciseMuscles) {
      if ($listExerciseMuscles->getIdExercise() == $exercise->getId()) {
        $distriXSportMyExercisesMusclesData = new DistriXSportMyExercisesMusclesData();
        $distriXSportMyExercisesMusclesData->setId($listExerciseMuscles->getId());
        $distriXSportMyExercisesMusclesData->setIdExercise($listExerciseMuscles->getIdExercise());
        $distriXSportMyExercisesMusclesData->setIdBodyMuscle($listExerciseMuscles->getIdBodyMuscle());
        foreach ($listBodyMusclesName as $bodyMusclesName) {
          if ($bodyMusclesName->getIdBodyMuscle() == $listExerciseMuscles->getIdBodyMuscle()){
            $distriXSportMyExercisesMusclesData->setNameBodyMuscle($bodyMusclesName->getName());
            break;
          }
        }
        $distriXSportMyExercisesMusclesData->setElemState($listExerciseMuscles->getElemState());
        $distriXSportMyExercisesMusclesData->setTimestamp($listExerciseMuscles->getTimestamp());
        $exerciseMuscles[] = $distriXSportMyExercisesMusclesData;
      }
    }
    $distriXSportMyExerciseData->setExerciseMuscles($exerciseMuscles);

    $distriXSportMyExerciseData->setElemState($exercise->getElemState());
    $distriXSportMyExerciseData->setTimestamp($exercise->getTimestamp());
  }
}

$resp["ViewMyExercise"]         = $distriXSportMyExerciseData;
$resp["ListMyExercisesMuscles"] = $listMyExerciseMusclesFormFront;
$resp["ListMyExercises"]        = $listMyExercisesFormFront;
if(!empty($error)){
  $resp["Error"]                = $error;
}

echo json_encode($resp);
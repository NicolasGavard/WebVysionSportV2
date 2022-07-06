<?php
session_start();
include(__DIR__ . "/../../../Init/ControllerInit.php");
// STY APP
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity/StyAppInterface/DistriXStyAppUser.php");
// DATA
include(__DIR__ ."/". CONTROLLER_DISTRIX_PATH."DistriXSecurity//Data/DistriXStyUserData.php");
include(__DIR__ . "/../Data/DistriXSportMyExercisesData.php");
include(__DIR__ . "/../../MyExercisesMuscles/Data/DistriXSportMyExercisesMusclesData.php");

$listMyExercises          = [];
$listMyExerciseMuscles    = [];
$listUsers                = [];
$listMyExercisesFormFront = [];
$_POST['idUserCoach']     = 1;
if (!empty($_POST) && isset($_POST)) {
  // List Users
  $listUsers              = DistriXStyAppUser::listUsers();

  // Exercise
  list($distriXSportCurrentDietData, $errorJson)    = DistriXSportMyExercisesData::getJsonData($_POST);
  list($distriXSportExerciseMuscleData, $errorJson) = DistriXSportMyExercisesMusclesData::getJsonData($_POST);

  // CALL
  $exerciseCaller = new DistriXServicesCaller();
  $exerciseCaller->setServiceName("App/Sport/MyExercises/Services/DistriXSportMyExercisesListDataSvc.php");
  $exerciseCaller->addParameter("data", $distriXSportCurrentDietData);
  
  $exerciseMuscleCaller = new DistriXServicesCaller();
  $exerciseMuscleCaller->setServiceName("App/Sport/MyExercisesMuscles/Services/DistriXSportMyExercisesMusclesListDataSvc.php");
  $exerciseMuscleCaller->addParameter("data", $distriXSportExerciseMuscleData);
   
  $svc = new DistriXSvc();
  $svc->addToCall("exercise", $exerciseCaller);
  $svc->addToCall("exerciseMuscle", $exerciseMuscleCaller);
  $callsOk = $svc->call();

  list($outputok, $output, $errorData) = $svc->getResult("exercise"); //print_r($output);
  if ($outputok && isset($output["ListMyExercises"]) && is_array($output["ListMyExercises"])) {
    list($listMyExercises, $jsonError) = DistriXSportMyExercisesData::getJsonArray($output["ListMyExercises"]);
  } else {
    $error = $errorData;
  }
  
  list($outputok, $output, $errorData) = $svc->getResult("exerciseMuscle"); print_r($output);
  if ($outputok && isset($output["ListMyExerciseMuscles"]) && is_array($output["ListMyExerciseMuscles"])) {
    list($listMyExerciseMuscles, $jsonError) = DistriXSportMyExercisesMusclesData::getJsonArray($output["ListMyExerciseMuscles"]);
  } else {
    $error = $errorData;
  }

  foreach ($listMyExercises as $currentDiet) {
    $distriXSportCurrentDietData = new DistriXSportMyExercisesData();

    public function setId(int $id) { $this->id = $id; }
    public function setIdUserCoach(int $idUserCoach) { $this->idUserCoach = $idUserCoach; }
    public function setNameUserCoach(string $nameUserCoach) { $this->nameUserCoach = $nameUserCoach; }
    public function setFirstNameUserCoach(string $firstNameUserCoach) { $this->firstNameUserCoach = $firstNameUserCoach; }
    public function setIdExerciseType(int $idExerciseType) { $this->idExerciseType = $idExerciseType; }
    public function setNameExerciseType(int $nameExerciseType) { $this->nameExerciseType = $nameExerciseType; }
    public function setCode(string $code) { $this->code = $code; }
    public function setName(string $name) { $this->name = $name; }
    public function setLinkToPicture(string $linkToPicture) { $this->linkToPicture = $linkToPicture; }
    public function setSize(int $size) { $this->size = $size; }
    public function setType(string $type) { $this->type = $type; }
    public function setExerciseMuscles(array $exerciseMuscles) { $this->exerciseMuscles = $exerciseMuscles; }
    public function setElemState(int $elemState) { $this->elemState = $elemState; }
    public function setTimestamp(int $timestamp) { $this->timestamp = $timestamp; }


    $distriXSportCurrentDietData->setId($currentDiet->getId());
    $distriXSportCurrentDietData->setIdUserCoach($currentDiet->getIdUserCoach());
    
    foreach ($listUsers as $user) {
      if ($currentDiet->getIdUserCoach() == $user->getId()){
        $distriXSportCurrentDietData->setNameUserCoach($user->getName());
        $distriXSportCurrentDietData->setFirstNameUserCoach($user->getFirstName());
      }
      if ($currentDiet->getIdUserStudent() == $user->getId()){
        $distriXSportCurrentDietData->setNameUserStudent($user->getName());
        $distriXSportCurrentDietData->setFirstNameUserStudent($user->getFirstName());
      }
    }

    $distriXSportCurrentDietData->setIdDietTemplate($currentDiet->getIdDietTemplate());
    $duration = 0;
    foreach ($listMyExerciseMuscles as $templateDiet) {
      if ($currentDiet->getIdDietTemplate() == $templateDiet->getId()) {
        $distriXSportCurrentDietData->setName($templateDiet->getName());
        $distriXSportCurrentDietData->setDuration($templateDiet->getDuration());
        $distriXSportCurrentDietData->setTags($templateDiet->getTags());
        $duration = $templateDiet->getDuration();
      }
    }

    $distriXSportCurrentDietData->setDateStart($currentDiet->getDateStart());
    
    $date_start         = DistriXSvcUtil::getjmaDate($currentDiet->getDateStart());
    $date_start         = $date_start[0].'-'.$date_start[1].'-'.$date_start[2];
    $date_rest          = new DateTime('now'); 
    // Trouver la date de fin
    $date_end           =  date('Y-m-d', strtotime($date_start. ' + '.$duration.' days'));
    $date_fin           = new DateTime($date_end);
    // Nombre de jours restant
    $interval           = $date_rest->diff($date_fin);
    $nbDaysInterval     = $interval->format('%d');

    // Faire pourcentage
    $advancement_rest   = 100;
    $advancement_done   = 100;
    if (str_replace("-", "", $date_end) > date('Ymd')){
      if ($duration > 0) {
        $advancement_rest = round(($nbDaysInterval / $duration) * 100, 2);
      }
      $advancement_done   = 100 - round($advancement_rest,2);
    }
    $distriXSportCurrentDietData->setAdvancement($advancement_done);
    $distriXSportCurrentDietData->setElemState($currentDiet->getElemState());
    $distriXSportCurrentDietData->setTimestamp($currentDiet->getTimestamp());
    $listMyExercisesFormFront[] = $distriXSportCurrentDietData;
  }
}

$resp["ListMyExercises"]  = $listMyExercisesFormFront;
$resp["ListMyExercisesMuscles"] = $listMyExerciseMuscles;
$resp["ListMyStudents"]       = $listUsers;
if(!empty($error)){
  $resp["Error"]              = $error;
}

echo json_encode($resp);